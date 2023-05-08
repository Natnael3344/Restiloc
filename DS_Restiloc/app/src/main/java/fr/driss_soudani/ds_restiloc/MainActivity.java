package fr.driss_soudani.ds_restiloc;

import androidx.appcompat.app.AppCompatActivity;

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
import android.widget.Toast;

import com.vishnusivadas.advanced_httpurlconnection.PutData;

import java.util.TreeMap;

public class MainActivity extends AppCompatActivity {

    TextView tvRefDossierExpertise;
    EditText etPiece, etQuantite, etDescription ;

    String refDossierExpertise;
    //TreeMap<String, String> prestationsREE;
    //String piece, quantite, description ;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        tvRefDossierExpertise = findViewById(R.id.tvRefDossierExpertise);
        etPiece = findViewById(R.id.etPiece);
        etQuantite = findViewById(R.id.etQuantite);
        etDescription = findViewById(R.id.etDescription);

        DatasExpertise datasExpertise = DatasExpertise.getInstance();

        refDossierExpertise = datasExpertise.getRef_dossier();
        tvRefDossierExpertise.setText(refDossierExpertise);

        //prestationsREE = datasExpertise.getPrestationsREE();




    }
}