package fr.driss_soudani.ds_restiloc;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;
import java.util.Map;
import java.util.TreeMap;

public class DatasExpertise {
    private String ref_dossier, dateCreation, folder, immatriculation ;
    //TreeMap< String, String > prestationsREE ;
    String[] PrestaPieces;
    String[] PrestaQuantites;
    String[] PrestaDescriptions;
    String[] PrestaPhotos;


    private static DatasExpertise holder = null;

    //Constructeur privé pour empécher la création de plusieurs instances
    private DatasExpertise(){
        ref_dossier = "";
        dateCreation = "";
        folder = "";
        immatriculation = "";


        //prestationsREE = new TreeMap < String, String > ( );
    }

    //Cette fonction doit être appelé pour créer l'objet DataExpertise
    //Si une instance exite déjà elle la retourne sinon elle crée une nouvelle instance
    public static DatasExpertise getInstance() {
        if(holder==null){
            holder = new DatasExpertise();
        }
        return holder;
    }


    public void setDatasDossierExpertise(String jsonString) {
        try {
            JSONObject dossierExpertise = new JSONObject(jsonString);
            holder.ref_dossier = dossierExpertise.getString("ref_dossier");
            holder.dateCreation = dossierExpertise.getString("dateCreation");
            holder.folder = dossierExpertise.getString("folder");
            holder.immatriculation = dossierExpertise.getString("immatriculation");


        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public void setDatasPrestationREE(String jsonString) {

        try {
           JSONArray prestationsREE = new JSONArray(jsonString);
           int nbrePrestations = prestationsREE.length();
            PrestaPieces = new String[nbrePrestations];
            PrestaQuantites = new String[nbrePrestations];
            PrestaDescriptions = new String[nbrePrestations];
            PrestaPhotos = new String[nbrePrestations];

            for (int i=0; i<nbrePrestations; i++){
                JSONObject presta = new JSONObject(String.valueOf(prestationsREE.getJSONObject(i)));
                PrestaPieces[i] = presta.getString("piece");
                PrestaQuantites[i] = presta.getString("quantite");
                PrestaDescriptions[i] = presta.getString("description");
                PrestaPhotos[i] = presta.getString("photo");
            /*
                holder.prestationsREE.put("id_pres", presta.getString("id_pres"));
                holder.prestationsREE.put("description", presta.getString("description"));
                holder.prestationsREE.put("quantite", presta.getString("quantite"));
                holder.prestationsREE.put("photo", presta.getString("photo"));
                holder.prestationsREE.put("piece", presta.getString("piece"));
                */

            }



        } catch (JSONException e) {
            e.printStackTrace();
        }
    }
/*
    public void setDatasPrestationREE(String jsonString) {
        try {
            JSONObject prestationsREE = new JSONObject(jsonString);
            for (int i=0; i<prestationsREE.length(); i++){
                holder.prestationsREE.put("id_pres", prestationsREE.getString("id_pres"));
                holder.prestationsREE.put("description", prestationsREE.getString("description"));
                holder.prestationsREE.put("quantite", prestationsREE.getString("quantite"));
                holder.prestationsREE.put("photo", prestationsREE.getString("photo"));
                holder.prestationsREE.put("piece", prestationsREE.getString("piece"));
            }



        } catch (JSONException e) {
            e.printStackTrace();
        }
    }
*/
    public String getRef_dossier() {
        return ref_dossier;
    }

    public String[] getPrestaPieces() {
        return PrestaPieces;
    }

    public String[] getPrestaQuantites() {
        return PrestaQuantites;
    }

    public String[] getPrestaDescriptions() {
        return PrestaDescriptions;
    }


    /*
    public TreeMap<String, String> getPrestationsREE() {
        return prestationsREE;
    }

    public void setPrestationsREE(TreeMap<String, String> prestationsREE) {
        this.prestationsREE = prestationsREE;
    }
*/

}
