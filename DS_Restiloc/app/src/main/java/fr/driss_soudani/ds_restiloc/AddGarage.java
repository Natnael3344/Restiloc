package fr.driss_soudani.ds_restiloc;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import androidx.appcompat.app.AppCompatActivity;

import java.io.IOException;

import okhttp3.FormBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;

public class AddGarage extends AppCompatActivity {

    EditText etNomGarage, etAdresseGarage, etCpGarage, etVilleGarage, etTelGarage;
    Button btnEnregistrer;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.custom_layout);

        etNomGarage = findViewById(R.id.et_nom_garage);
        etAdresseGarage = findViewById(R.id.et_adresse_garage);
        etCpGarage = findViewById(R.id.et_cp_garage);
        etVilleGarage = findViewById(R.id.et_ville_garage);
        etTelGarage = findViewById(R.id.et_tel_garage);
        btnEnregistrer = findViewById(R.id.btn_enregistrer);

        btnEnregistrer.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String nomGarage = etNomGarage.getText().toString();
                String adresseGarage = etAdresseGarage.getText().toString();
                String cpGarage = etCpGarage.getText().toString();
                String villeGarage = etVilleGarage.getText().toString();
                String telGarage = etTelGarage.getText().toString();

                enregistrerGarage(nomGarage, adresseGarage, cpGarage, villeGarage, telGarage);
            }
        });
    }

    private void enregistrerGarage(String nomGarage, String adresseGarage, String cpGarage, String villeGarage, String telGarage) {
        OkHttpClient client = new OkHttpClient();

        RequestBody formBody = new FormBody.Builder()
                .add("nom_garage", nomGarage)
                .add("adresse_garage", adresseGarage)
                .add("cp_garage", cpGarage)
                .add("ville_garage", villeGarage)
                .add("tel_garage", telGarage)
                .build();

        Request request = new Request.Builder()
                .url("http://192.168.0.108/restilloc_location-main/ajout_nv_garage.php")
                .post(formBody)
                .build();

        try {
            Response response = client.newCall(request).execute();
            assert response.body() != null;
            String responseBody = response.body().string();
            // Handle the response here
            System.out.println(responseBody);
//            Toast.makeText(this, responseBody, Toast.LENGTH_SHORT).show();
        } catch (IOException e) {
            e.printStackTrace();
//            Toast.makeText(this, "Error: " + e.getMessage(), Toast.LENGTH_SHORT).show();
        }
    }
}

