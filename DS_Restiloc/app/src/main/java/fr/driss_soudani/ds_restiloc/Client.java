package fr.driss_soudani.ds_restiloc;

public class Client {
    private int id;
    private String name;
    private String preNom;
    private String address;
    private String postal;
    private String ville;
    private String telephone;
    private String portable;
    private String email;

    public Client(int id, String name, String preNom, String address, String postal, String ville, String telephone, String portable, String email) {
        this.id = id;
        this.name = name;
        this.preNom = preNom;
        this.address = address;
        this.postal = postal;
        this.ville = ville;
        this.telephone = telephone;
        this.portable = portable;
        this.email = email;
    }

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

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getPostal() {
        return postal;
    }

    public void setPostal(String postal) {
        this.postal = postal;
    }

    public String getVille() {
        return ville;
    }

    public void setVille(String ville) {
        this.ville = ville;
    }

    public String getTelephone() {
        return telephone;
    }

    public void setTelephone(String telephone) {
        this.telephone = telephone;
    }

    public String getPortable() {
        return portable;
    }

    public void setPortable(String portable) {
        this.portable = portable;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }
}
