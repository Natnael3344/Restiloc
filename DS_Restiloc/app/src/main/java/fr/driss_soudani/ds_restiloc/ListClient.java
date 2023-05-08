package fr.driss_soudani.ds_restiloc;

import android.os.Bundle;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.RecyclerView;

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

public class ListClient extends AppCompatActivity {
    private ClientListAdapter adapter;

    private ArrayList<Client> clientList;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_list_c);

        // Initialize garage list
        clientList = new ArrayList<>();

        // Initialize list view and adapter
        RecyclerView clientListView = findViewById(R.id.recyclerView_client);
        adapter = new ClientListAdapter(clientList, this);
        clientListView.setAdapter(adapter);

        // Fetch garages from backend PHP script
        fetchClients();
    }
    private void fetchClients() {
        StringRequest stringRequest = new StringRequest(Request.Method.GET, "http://your_ip/restilloc_location-main/client_list.php",
                response -> {
                    try {
                        System.out.println(response);
                        JSONArray jsonArray = new JSONArray(response);

                        // Iterate through JSON array and add garages to list
                        for (int i = 0; i < jsonArray.length(); i++) {
                            JSONObject jsonObject = jsonArray.getJSONObject(i);
                            int id = jsonObject.getInt("id_client");
                            String name = jsonObject.getString("nom_client");
                            String preNom = jsonObject.getString("prenom_client");
                            String address = jsonObject.getString("adresse_client");
                            String postal = jsonObject.getString("cp_client");
                            String ville = jsonObject.getString("ville_client");
                            String telephone = jsonObject.getString("tel_client");
                            String portable = jsonObject.getString("portable_client");
                            String email = jsonObject.getString("email_client");
                            Client client = new Client(id, name, preNom,address,postal,ville, telephone,portable,email);
                            clientList.add(client);
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
                Toast.makeText(ListClient.this, "Error: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        // Add request to request queue
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
}
