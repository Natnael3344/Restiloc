package fr.driss_soudani.ds_restiloc;


import org.json.JSONException;
import org.json.JSONObject;

public class DatasExpert {
    private String nomExpert, prenomExpert;
    private static DatasExpert holder = null;

    //Constructeur privé pour empécher la création de plusieurs instances
    private DatasExpert(){
        nomExpert = "";
        prenomExpert = "" ;
    }

    //Cette fonction doit être appelé pour créer l'objet DatasExpert
    //Si une instance exite déjà elle la retourne sinon elle crée une nouvelle instance
    public static DatasExpert getInstance() {
        if(holder==null){
            holder = new DatasExpert();
        }
        return holder;
    }

    public String getNomExpert() {
        return nomExpert;
    }

    public String getPrenomExpert() {
        return prenomExpert;
    }

    public void setDatasExpert(String jsonString) {
        try {
            JSONObject expert = new JSONObject(jsonString);
            holder.nomExpert = expert.getString("nom_exp");
            holder.prenomExpert = expert.getString("prenom_exp");

        } catch (JSONException e) {
            e.printStackTrace();
        }
    }
}