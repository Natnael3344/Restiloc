package fr.driss_soudani.ds_restiloc;

import android.annotation.SuppressLint;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import androidx.appcompat.app.AppCompatActivity;

import com.google.firebase.crashlytics.buildtools.reloc.org.apache.http.NameValuePair;
import com.google.firebase.crashlytics.buildtools.reloc.org.apache.http.client.HttpClient;
import com.google.firebase.crashlytics.buildtools.reloc.org.apache.http.client.entity.UrlEncodedFormEntity;
import com.google.firebase.crashlytics.buildtools.reloc.org.apache.http.client.methods.HttpPost;
import com.google.firebase.crashlytics.buildtools.reloc.org.apache.http.impl.client.DefaultHttpClient;
import com.google.firebase.crashlytics.buildtools.reloc.org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONObject;
import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.List;

public class SearchVehicles extends AppCompatActivity {

    ListView listView;
    ArrayAdapter<String> adapter;
    List<String> data = new ArrayList<>();



    @SuppressLint("MissingInflatedId")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.custom_layout);

        listView = findViewById(R.id.listview);
        adapter = new ArrayAdapter<>(this, android.R.layout.simple_list_item_1, data);
        listView.setAdapter(adapter);

        new RetrieveDataTask().execute("ABC"); // replace ABC with your search term
    }

    private class RetrieveDataTask extends AsyncTask<String, Void, String> {

        private Exception exception;

        protected String doInBackground(String... searchQuery) {
            try {
                HttpClient client = new DefaultHttpClient();
                HttpPost request = new HttpPost("http://192.168.0.108/restilloc_location-main/search_vehicles.php");

                // Add search term as a parameter to the POST request
                List<NameValuePair> params = new ArrayList<>();
                params.add(new BasicNameValuePair("search", searchQuery[0]));
                request.setEntity(new UrlEncodedFormEntity(params));

                // Execute the POST request and retrieve the response
                InputStream inputStream = client.execute(request).getEntity().getContent();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
                StringBuilder stringBuilder = new StringBuilder();
                String line;
                while ((line = bufferedReader.readLine()) != null) {
                    stringBuilder.append(line);
                }
                inputStream.close();

                return stringBuilder.toString();
            } catch (Exception e) {
                this.exception = e;
                return null;
            }
        }

        protected void onPostExecute(String result) {
            if (result != null) {
                try {
                    JSONArray jsonArray = new JSONArray(result);
                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject jsonObject = jsonArray.getJSONObject(i);
                        String immatriculation = jsonObject.getString("immatriculation");
                        String motorisation = jsonObject.getString("motorisation");
                        String date_circulation = jsonObject.getString("date_circulation");
                        String id_client = jsonObject.getString("id_client");
                        String id_modele = jsonObject.getString("id_modele");
                        String item = immatriculation + " " + motorisation + " " + date_circulation + " " + id_client + " " + id_modele;
                        data.add(item);
                    }
                    adapter.notifyDataSetChanged();
                } catch (Exception e) {
                    Log.e("JSON", "Error parsing JSON", e);
                }
            } else {
                Log.e("HTTP", "Error retrieving data from server");
            }
        }
    }
}
