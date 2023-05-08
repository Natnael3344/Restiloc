package fr.driss_soudani.ds_restiloc;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.vishnusivadas.advanced_httpurlconnection.PutData;

import java.net.URISyntaxException;

public class AccueilExpert extends AppCompatActivity {
    String expertName ;
    TextView tvExpertName;
    Button btnSearch,btnAccederDossierExpertise,btnListGarage,btnListExpert,btnListClient;
    EditText etImmatriculation ;


    TextView tvMarque, tvModele, tvDateMEC, tvImmatriculation , tvNomPrenomClient, tvAdresseClient, tvCpClient, tvVilleClient, tvPortableClient;

    TextView etDescription, etQuantite, etPiece;


    LinearLayout layerInfosVehicule, layerInfosClient;

    //Adresse complète du fichier php situé sur le serveur qui va executé le script de select des données voiture et client
    private static String URL_1 = "http://your_ip/restilloc_location-main/search_vehicles.php";

    //Adresse complète du fichier php situé sur le serveur qui créer ou ouvrir le dossier de restitution
    private static String URL_2 = "http://your_ip/restilloc_location-main/dossier_restitution.php";



    @SuppressLint("MissingInflatedId")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_accueil_expert);

        tvExpertName = findViewById(R.id.nameExpert);
        btnSearch = findViewById(R.id.btnSearch);
        etImmatriculation = findViewById(R.id.etImmatriculation);

        tvMarque = findViewById(R.id.tvMarque);
        tvModele = findViewById(R.id.tvModele);
        tvImmatriculation = findViewById(R.id.tvImmatriculation);
        tvDateMEC = findViewById(R.id.tvDateMEC);

        tvNomPrenomClient = findViewById(R.id.tvNomPrenomClient);
        tvAdresseClient = findViewById(R.id.tvAdresseClient);
        tvCpClient = findViewById(R.id.tvCpClient);
        tvVilleClient = findViewById(R.id.tvVilleClient);
        tvPortableClient = findViewById(R.id.tvPortableClient);

        btnAccederDossierExpertise = findViewById(R.id.btnAccederDossierExpertise);
        btnListGarage = findViewById(R.id.btnListGarage);
        btnListExpert = findViewById(R.id.btnListExpert);
        btnListClient = findViewById(R.id.btnListClient);
        layerInfosVehicule = findViewById(R.id.layerInfosVehicule);
        layerInfosClient = findViewById(R.id.layerInfosClient);
        etDescription = findViewById(R.id.etDescription);
        etQuantite = findViewById(R.id.etQuantite);
        etPiece = findViewById(R.id.etPiece);
        DatasExpert dataExpert = DatasExpert.getInstance();

        expertName = dataExpert.getNomExpert() + " " + dataExpert.getPrenomExpert();

        tvExpertName.setText(expertName);

        btnSearch.setOnClickListener(onClickListener);
        btnAccederDossierExpertise.setOnClickListener(onClickListener);
        btnListGarage.setOnClickListener(onClickListener);
        btnListExpert.setOnClickListener(onClickListener);
        btnListClient.setOnClickListener(onClickListener);
    }

    private void traiterClickSurBtnChercher() throws URISyntaxException {
        String immatriculation;
        immatriculation = etImmatriculation.getText().toString().trim();
        if(!immatriculation.equals("")) {
            Handler handler = new Handler(Looper.getMainLooper());
            handler.post(new Runnable() {
                @Override
                public void run() {
                    //Création de la clé du paramètre à envoyer
                    String[] keys = new String[1];
                    keys[0] = "search";

                    //Création de la valeur du paramètre à envoyer
                    String[] values = new String[1];
                    values[0] = immatriculation;

                    PutData putData = new PutData(URL_1, "POST", keys, values);

                    if (putData.startPut()) {
                        if (putData.onComplete()) {
                            String result = putData.getResult();
                            String[] msg = result.split("%");
                            if(result.equals("No results found")){

                                System.out.println(result);
//                                Toast.makeText(getApplicationContext(), msg[1], Toast.LENGTH_SHORT).show();


                            }else{

                                System.out.println(result);
//                                Toast.makeText(getApplicationContext(), "Infos voiture récupérées", Toast.LENGTH_SHORT).show();
//
                                DatasVoiture datasVoiture = DatasVoiture.getInstance();
                                datasVoiture.setDatasVoiture(result);
                                String marque = datasVoiture.getNomMarque();
                                tvMarque.setText(marque);
                                tvModele.setText(datasVoiture.getNomModele().toString());
                                tvImmatriculation.setText(datasVoiture.getImmatriculation().toString());
                                tvDateMEC.setText(datasVoiture.getDateMEC().toString());
//
                                String nomPrenomClient = datasVoiture.getNomClient()+" "+datasVoiture.getPrenomClient();
                                tvNomPrenomClient.setText(nomPrenomClient);
                                tvAdresseClient.setText(datasVoiture.getAdresseClient().toString());
                                tvCpClient.setText(datasVoiture.getCpClient().toString());
                                tvVilleClient.setText(datasVoiture.getVilleClient().toString());
                                tvPortableClient.setText(datasVoiture.getCpClient().toString());
                                btnAccederDossierExpertise.setVisibility(View.VISIBLE);
                                layerInfosVehicule.setVisibility(View.VISIBLE);
                                layerInfosClient.setVisibility(View.VISIBLE);
                              }

                            Log.i("Driss MSG", "PutData = "+result);
                        }
                    }
                }
            });
        }
    }

    private void traiterClickSurBtnAccederDataGarage(){
        //Créer le dossier de restitution ou uvrir le dossier de resititution
        String immatriculation;
        immatriculation = DatasVoiture.getInstance().getImmatriculation();
        Handler handler = new Handler(Looper.getMainLooper());
        handler.post(new Runnable() {
            @Override
            public void run() {
                String[] keys = new String[1];
                keys[0] = "submit";

                String[] values = new String[1];
                values[0] = immatriculation;
                Intent intent = new Intent(getApplicationContext(), ListGarage.class);
                startActivity(intent);
                finish();
//                PutData putData = new PutData(URL_2, "POST", keys, values);
//                if (putData.startPut()) {
//                    if (putData.onComplete()) {
//                        String result = putData.getResult();
//                        String[] msg = result.split("%");
//                            if(result.equals("Error inserting data")){
//                                Toast.makeText(getApplicationContext(), result, Toast.LENGTH_SHORT).show();
//                        }else{
//
//                                Toast.makeText(getApplicationContext(), "Dossier de restitution ouvert", Toast.LENGTH_SHORT).show();
//
//                                DatasExpertise datasExpertise = DatasExpertise.getInstance();
//                                datasExpertise.setDatasDossierExpertise(result);
//                                datasExpertise.setDatasPrestationREE(result);
//
//                                Intent intent = new Intent(getApplicationContext(), ListePrestations.class);
//                                startActivity(intent);
//                                finish();
//                        }
//
//                        Log.i("Driss MSG", "PutData = "+result);
                   // }
               // }
            }
        });
    }

    private void traiterClickSurBtnListClient(){
        //Créer le dossier de restitution ou uvrir le dossier de resititution
        String immatriculation;
        immatriculation = DatasVoiture.getInstance().getImmatriculation();
        Handler handler = new Handler(Looper.getMainLooper());
        handler.post(new Runnable() {
            @Override
            public void run() {
                String[] keys = new String[1];
                keys[0] = "submit";

                String[] values = new String[1];
                values[0] = immatriculation;
                Intent intent = new Intent(getApplicationContext(), ListClient.class);
                startActivity(intent);
                finish();
//                PutData putData = new PutData(URL_2, "POST", keys, values);
//                if (putData.startPut()) {
//                    if (putData.onComplete()) {
//                        String result = putData.getResult();
//                        String[] msg = result.split("%");
//                            if(result.equals("Error inserting data")){
//                                Toast.makeText(getApplicationContext(), result, Toast.LENGTH_SHORT).show();
//                        }else{
//
//                                Toast.makeText(getApplicationContext(), "Dossier de restitution ouvert", Toast.LENGTH_SHORT).show();
//
//                                DatasExpertise datasExpertise = DatasExpertise.getInstance();
//                                datasExpertise.setDatasDossierExpertise(result);
//                                datasExpertise.setDatasPrestationREE(result);
//
//                                Intent intent = new Intent(getApplicationContext(), ListePrestations.class);
//                                startActivity(intent);
//                                finish();
//                        }
//
//                        Log.i("Driss MSG", "PutData = "+result);
                // }
                // }
            }
        });
    }
    private void traiterClickSurBtnAccederDossierExpertise(){
        //Créer le dossier de restitution ou uvrir le dossier de resititution
        String immatriculation;
        immatriculation = DatasVoiture.getInstance().getImmatriculation();
        Handler handler = new Handler(Looper.getMainLooper());
        handler.post(new Runnable() {
            @Override
            public void run() {
                String[] keys = new String[1];
                keys[0] = "submit";

                String[] values = new String[1];
                values[0] = immatriculation;
                Intent intent = new Intent(getApplicationContext(), AddGarage.class);
                startActivity(intent);
                finish();
//                PutData putData = new PutData(URL_2, "POST", keys, values);
//                if (putData.startPut()) {
//                    if (putData.onComplete()) {
//                        String result = putData.getResult();
//                        String[] msg = result.split("%");
//                            if(result.equals("Error inserting data")){
//                                Toast.makeText(getApplicationContext(), result, Toast.LENGTH_SHORT).show();
//                        }else{
//
//                                Toast.makeText(getApplicationContext(), "Dossier de restitution ouvert", Toast.LENGTH_SHORT).show();
//
//                                DatasExpertise datasExpertise = DatasExpertise.getInstance();
//                                datasExpertise.setDatasDossierExpertise(result);
//                                datasExpertise.setDatasPrestationREE(result);
//
//                                Intent intent = new Intent(getApplicationContext(), ListePrestations.class);
//                                startActivity(intent);
//                                finish();
//                        }
//
//                        Log.i("Driss MSG", "PutData = "+result);
                // }
                // }
            }
        });
    }

    private void traiterClickSurBtnListExpert(){
        //Créer le dossier de restitution ou uvrir le dossier de resititution
        String immatriculation;
        immatriculation = DatasVoiture.getInstance().getImmatriculation();
        Handler handler = new Handler(Looper.getMainLooper());
        handler.post(new Runnable() {
            @Override
            public void run() {
                String[] keys = new String[1];
                keys[0] = "submit";

                String[] values = new String[1];
                values[0] = immatriculation;
                Intent intent = new Intent(getApplicationContext(), ListExpert.class);
                startActivity(intent);
                finish();
//                PutData putData = new PutData(URL_2, "POST", keys, values);
//                if (putData.startPut()) {
//                    if (putData.onComplete()) {
//                        String result = putData.getResult();
//                        String[] msg = result.split("%");
//                            if(result.equals("Error inserting data")){
//                                Toast.makeText(getApplicationContext(), result, Toast.LENGTH_SHORT).show();
//                        }else{
//
//                                Toast.makeText(getApplicationContext(), "Dossier de restitution ouvert", Toast.LENGTH_SHORT).show();
//
//                                DatasExpertise datasExpertise = DatasExpertise.getInstance();
//                                datasExpertise.setDatasDossierExpertise(result);
//                                datasExpertise.setDatasPrestationREE(result);
//
//                                Intent intent = new Intent(getApplicationContext(), ListePrestations.class);
//                                startActivity(intent);
//                                finish();
//                        }
//
//                        Log.i("Driss MSG", "PutData = "+result);
                // }
                // }
            }
        });
    }

    private final View.OnClickListener onClickListener = new View.OnClickListener() {
        @SuppressLint("NonConstantResourceId")
        @Override
        public void onClick(View v) {
            switch(v.getId()){
                case R.id.btnSearch:
                    try {
                        traiterClickSurBtnChercher();
                    } catch (URISyntaxException e) {
                        throw new RuntimeException(e);
                    }
                    break;
                case R.id.btnAccederDossierExpertise:
                    traiterClickSurBtnAccederDossierExpertise();
                    break;
                case R.id.btnListGarage:
                    traiterClickSurBtnAccederDataGarage();
                    break;
                case R.id.btnListExpert:
                    traiterClickSurBtnListExpert();
                    break;
                case R.id.btnListClient:
                    traiterClickSurBtnListClient();
                    break;
            }

        }
    };
}
