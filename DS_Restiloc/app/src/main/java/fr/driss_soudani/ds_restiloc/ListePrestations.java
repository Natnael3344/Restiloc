package fr.driss_soudani.ds_restiloc;

import android.annotation.SuppressLint;
import android.app.ListActivity;
import android.os.Bundle;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.TextView;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import java.util.TreeMap;

public class ListePrestations extends AppCompatActivity {

    ListView lvPrestations;
    TextView tvRefDossierExpertise;

    String refDossierExpertise;
    String[] PrestaPieces;
    String[] PrestaQuantites;
    String[] PrestaDescriptions;
    LinearLayout Button;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_liste_prestations);


        lvPrestations = findViewById(R.id.listePrestations);
        tvRefDossierExpertise = findViewById(R.id.tvRefDossierExpertise);

        DatasExpertise datasExpertise = DatasExpertise.getInstance();

        refDossierExpertise = datasExpertise.getRef_dossier();
        tvRefDossierExpertise.setText(refDossierExpertise);

        PrestaPieces = datasExpertise.getPrestaPieces();
        PrestaQuantites = datasExpertise.getPrestaQuantites();
        PrestaDescriptions = datasExpertise.getPrestaDescriptions();

        CustomAdapter customAdapter = new CustomAdapter();
        lvPrestations.setAdapter(customAdapter);
    }


    class CustomAdapter extends BaseAdapter {

        @Override
        public int getCount() {
            return PrestaPieces.length;
        }

        @Override
        public Object getItem(int i) {
            return null;
        }

        @Override
        public long getItemId(int i) {
            return 0;
        }

        @SuppressLint("ViewHolder")
        @Override
        public View getView(int i, View view, ViewGroup viewGroup) {
            view = getLayoutInflater().inflate(R.layout.custom_layout, null);
            EditText etPiece = view.findViewById(R.id.etPiece);
            EditText etQuantite = view.findViewById(R.id.etQuantite);
            EditText etDescription = view.findViewById(R.id.etDescription);

            etPiece.setText(PrestaPieces[i]);
            etQuantite.setText(PrestaQuantites[i]);
            etDescription.setText(PrestaDescriptions[i]);
            return view;
        }
    }
}
