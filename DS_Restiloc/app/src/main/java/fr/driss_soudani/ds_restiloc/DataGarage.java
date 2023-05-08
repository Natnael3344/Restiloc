package fr.driss_soudani.ds_restiloc;

import org.json.JSONException;
import org.json.JSONObject;

public class DataGarage {
    private String  nom_garage,adresse_garage, cp_garage,ville_garage, tel_garage;



    private static DataGarage holder = null;
    private DataGarage(){
        nom_garage = "";
        adresse_garage = "" ;
        cp_garage = "";
        ville_garage = "";
        tel_garage = "";
    }
    public static DataGarage getInstance() {
        if(holder==null){
            holder = new DataGarage();
        }
        return holder;
    }
    public void setDataGarage(String jsonString) {
        try {
            JSONObject expert = new JSONObject(jsonString);
            holder.nom_garage = expert.getString("nom_garage");
            holder.adresse_garage = expert.getString("adresse_garage");
            holder.cp_garage = expert.getString("cp_garage");
            holder.ville_garage = expert.getString("ville_garage");
            holder.tel_garage = expert.getString("tel_garage");

        } catch (JSONException e) {
            e.printStackTrace();
        }
    }
    public String getNom_garage() {
        return nom_garage;
    }

    public String getAdresse_garage() {
        return adresse_garage;
    }

    public String getCp_garage() {
        return cp_garage;
    }

    public String getVille_garage() {
        return ville_garage;
    }

    public String getTel_garage() {
        return tel_garage;
    }
}

