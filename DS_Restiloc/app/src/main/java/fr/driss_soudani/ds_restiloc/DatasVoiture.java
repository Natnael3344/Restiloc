package fr.driss_soudani.ds_restiloc;

import org.json.JSONException;
import org.json.JSONObject;

public class DatasVoiture {

    private String nomClient, prenomClient, adresseClient, cpClient, villeClient, portableClient,immatriculation, dateMEC, nomMarque, nomModele ;


    private static DatasVoiture holder = null;

    //Constructeur privé pour empécher la création de plusieurs instances
    private DatasVoiture(){
        nomClient = "";
        prenomClient = "" ;
        adresseClient = "";
        cpClient = "";
        villeClient = "";
        portableClient = "";

        immatriculation = "";
        dateMEC = "";
        nomMarque = "";
        nomModele = "";

    }

    //Cette fonction doit être appelé pour créer l'objet DatasVoiture
    //Si une instance exite déjà elle la retourne sinon elle crée une nouvelle instance
    public static DatasVoiture getInstance() {
        if(holder==null){
            holder = new DatasVoiture();
        }
        return holder;
    }

    public void setDatasVoiture(String jsonString) {
        try {
            JSONObject expert = new JSONObject(jsonString);
            holder.nomClient = expert.getString("nom_client");
            holder.prenomClient = expert.getString("prenom_client");
            holder.adresseClient = expert.getString("adresse_client");
            holder.cpClient = expert.getString("cp_client");
            holder.villeClient = expert.getString("ville_client");
            holder.portableClient = expert.getString("portable_client");

            holder.immatriculation = expert.getString("immatriculation");
            holder.dateMEC = expert.getString("date_circulation");
            holder.nomMarque = expert.getString("id_client");
            holder.nomModele = expert.getString("id_modele");

        } catch (JSONException e) {
            e.printStackTrace();
        }
    }


    public String getNomClient() {
        return nomClient;
    }

    public String getPrenomClient() {
        return prenomClient;
    }

    public String getAdresseClient() {
        return adresseClient;
    }

    public String getCpClient() {
        return cpClient;
    }

    public String getVilleClient() {
        return villeClient;
    }

    public String getPortableClient() {
        return portableClient;
    }

    public String getImmatriculation() {
        return immatriculation;
    }

    public String getDateMEC() {
        return dateMEC;
    }

    public String getNomMarque() {
        return nomMarque;
    }

    public String getNomModele() {
        return nomModele;
    }
}
