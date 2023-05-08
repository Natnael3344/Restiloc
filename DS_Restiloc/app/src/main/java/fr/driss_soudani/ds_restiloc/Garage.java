package fr.driss_soudani.ds_restiloc;

public class Garage {
    private int id;
    private String name;
    private String address;
    private String city;
    private String postcode;
    private String telephone;

    public Garage(int id, String name, String address, String city, String postcode, String telephone) {
        this.id = id;
        this.name = name;
        this.address = address;
        this.city = city;
        this.postcode = postcode;
        this.telephone = telephone;
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

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getPostcode() {
        return postcode;
    }

    public void setPostcode(String postcode) {
        this.postcode = postcode;
    }

    public String getTelephone() {
        return telephone;
    }

    public void setTelephone(String telephone) {
        this.telephone = telephone;
    }
}
