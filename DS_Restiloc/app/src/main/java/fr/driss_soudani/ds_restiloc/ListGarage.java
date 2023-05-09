package fr.driss_soudani.ds_restiloc;

import android.os.Bundle;
import android.widget.ListView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;


public class ListGarage extends AppCompatActivity {

    private GarageListAdapter adapter;

    private ArrayList<Garage> garageList;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_list);

        // Initialize garage list
        garageList = new ArrayList<>();

        // Initialize list view and adapter
        ListView garageListView = findViewById(R.id.recyclerView_garages);
        adapter = new GarageListAdapter(this, garageList);
        garageListView.setAdapter(adapter);

        // Fetch garages from backend PHP script
        fetchGarages();
    }

    private void fetchGarages() {
        StringRequest stringRequest = new StringRequest(Request.Method.GET, "http://194.214.234.254/restilloc_location-main/garage_list.php",
                response -> {
                    try {
                        System.out.println(response);
                        JSONArray jsonArray = new JSONArray(response);

                        // Iterate through JSON array and add garages to list
                        for (int i = 0; i < jsonArray.length(); i++) {
                            JSONObject jsonObject = jsonArray.getJSONObject(i);
                            int id = jsonObject.getInt("id_garage");
                            String name = jsonObject.getString("nom_garage");
                            String address = jsonObject.getString("adresse_garage");
                            String postalCode = jsonObject.getString("cp_garage");
                            String city = jsonObject.getString("ville_garage");
                            String phone = jsonObject.getString("tel_garage");

                            Garage garage = new Garage(id, name, address, postalCode, city, phone);
                            garageList.add(garage);
                        }
                        System.out.println("grage agacdjdjdc");
                        System.out.println(garageList);
                        // Notify adapter about changes in list
                        adapter.notifyDataSetChanged();

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                // Handle error
                Toast.makeText(ListGarage.this, "Error: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        // Add request to request queue
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
}
