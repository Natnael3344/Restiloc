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

public class ListExpert extends AppCompatActivity {
    private ExpertListAdapter adapter;

    private ArrayList<Expert> expertList;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_list_e);

        // Initialize garage list
        expertList = new ArrayList<>();

        // Initialize list view and adapter
        ListView expertListView = findViewById(R.id.recyclerView_expert);
        adapter = new ExpertListAdapter(this, expertList);
        expertListView.setAdapter(adapter);

        // Fetch garages from backend PHP script
        fetchExperts();
    }
    private void fetchExperts() {
        StringRequest stringRequest = new StringRequest(Request.Method.GET, "http://194.214.234.254/restilloc_location-main/expert_list.php",
                response -> {
                    try {
                        System.out.println(response);
                        JSONArray jsonArray = new JSONArray(response);

                        // Iterate through JSON array and add garages to list
                        for (int i = 0; i < jsonArray.length(); i++) {
                            JSONObject jsonObject = jsonArray.getJSONObject(i);
                            int id = jsonObject.getInt("id_expert");
                            String name = jsonObject.getString("nom_expert");
                            String preNom = jsonObject.getString("prenom_expert");
                            String telephone = jsonObject.getString("tel_expert");
                            String mail = jsonObject.getString("mail_expert");


                            Expert expert = new Expert(id, name, preNom, telephone, mail);
                            expertList.add(expert);
                        }
                        System.out.println("grage agacdjdjdc");

                        // Notify adapter about changes in list
                        adapter.notifyDataSetChanged();

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                // Handle error
                Toast.makeText(ListExpert.this, "Error: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        // Add request to request queue
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
}
