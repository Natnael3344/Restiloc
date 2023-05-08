package fr.driss_soudani.ds_restiloc;

public class Expert {
    private int id;
    private String name;
    private String preNom;
    private String telephone;
    private String mail;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPreNom() {
        return preNom;
    }

    public void setPreNom(String preNom) {
        this.preNom = preNom;
    }

    public String getTelephone() {
        return telephone;
    }

    public void setTelephone(String telephone) {
        this.telephone = telephone;
    }

    public String getMail() {
        return mail;
    }

    public void setMail(String mail) {
        this.mail = mail;
    }



    public Expert(int id, String name, String preNom, String telephone, String mail) {
        this.id = id;
        this.name = name;
        this.preNom = preNom;
        this.telephone = telephone;
        this.mail = mail;

    }
}
