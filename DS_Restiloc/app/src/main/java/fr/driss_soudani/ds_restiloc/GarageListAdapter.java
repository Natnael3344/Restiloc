package fr.driss_soudani.ds_restiloc;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.List;

public class GarageListAdapter extends BaseAdapter {
    private Context mContext;
    private List<Garage> mGarageList;

    public GarageListAdapter(Context context, List<Garage> garageList) {
        mContext = context;
        mGarageList = garageList;
    }

    @Override
    public int getCount() {
        return mGarageList.size();
    }

    @Override
    public Object getItem(int position) {
        return mGarageList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            LayoutInflater inflater = LayoutInflater.from(mContext);
            convertView = inflater.inflate(R.layout.activity_list_garage, null);
        }

        Garage garage = mGarageList.get(position);

        TextView nameTextView =  convertView.findViewById(R.id.textView_nom_garage);
        nameTextView.setText(garage.getName());

        TextView addressTextView = convertView.findViewById(R.id.textView_adresse_garage);
        addressTextView.setText(garage.getAddress());

        TextView cpTextView = convertView.findViewById(R.id.textView_cp_garage);
        cpTextView.setText(garage.getCity());

        TextView villeTextView = convertView.findViewById(R.id.textView_ville_garage);
        villeTextView.setText(garage.getPostcode());

        TextView phoneTextView = convertView.findViewById(R.id.textView_tel_garage);
        phoneTextView.setText(garage.getTelephone());

        return convertView;
    }
}

