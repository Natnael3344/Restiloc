package fr.driss_soudani.ds_restiloc;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.List;

public class ClientListAdapter extends RecyclerView.Adapter<ClientListAdapter.ViewHolder>  {
    private List<Client> clientList;
    private Context context;

    public ClientListAdapter(List<Client> clientList, Context context) {
        this.clientList = clientList;
        this.context = context;
    }

    public class ViewHolder extends RecyclerView.ViewHolder {

        public TextView nameTextView ;

        public TextView foreTextView ;

        public TextView addressTextView ;

        public TextView postalTextView ;

        public TextView villeTextView ;

        public TextView telephoneTextView ;

        public TextView portableTextView ;

        public TextView emailTextView ;
        public ViewHolder(View itemView) {
            super(itemView);

            nameTextView =  itemView.findViewById(R.id.textView_nom_client);

            foreTextView = itemView.findViewById(R.id.textView_prenom_client);

            addressTextView = itemView.findViewById(R.id.textView_adresse_client);

            postalTextView = itemView.findViewById(R.id.textView_cp_client);

            villeTextView = itemView.findViewById(R.id.textView_ville_client);

            telephoneTextView = itemView.findViewById(R.id.textView_tel_client);

            portableTextView = itemView.findViewById(R.id.textView_portable_client);

            emailTextView = itemView.findViewById(R.id.textView_email_client);

        }
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.activity_list_client, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        Client client = clientList.get(position);

        holder.nameTextView.setText(client.getName());

        holder.foreTextView.setText(client.getPreNom());

        holder.addressTextView.setText(client.getAddress());

        holder.postalTextView.setText(client.getPostal());

        holder.villeTextView.setText(client.getVille());

        holder.telephoneTextView.setText(client.getTelephone());

        holder.portableTextView.setText(client.getPortable());

        holder.emailTextView.setText(client.getEmail());
    }

    @Override
    public int getItemCount() {
        return clientList.size();
    }
//    public ClientListAdapter(Context context, List<Client> clientList) {
//        mContext = context;
//        mClientList = clientList;
//    }
//    @Override
//    public int getCount() {
//        return mClientList.size();
//    }
//
//    @Override
//    public Object getItem(int position) {
//        return mClientList.get(position);
//    }
//
//    @Override
//    public long getItemId(int position) {
//        return position;
//    }
//    @Override
//    public View getView(int position, View convertView, ViewGroup parent) {
//        if (convertView == null) {
//            LayoutInflater inflater = LayoutInflater.from(mContext);
//            convertView = inflater.inflate(R.layout.activity_list_client, null);
//        }
//
//        Client client = mClientList.get(position);
//
//        TextView nameTextView =  convertView.findViewById(R.id.textView_nom_client);
//        nameTextView.setText(client.getName());
//
//        TextView foreTextView = convertView.findViewById(R.id.textView_prenom_client);
//        foreTextView.setText(client.getPreNom());
//
//        TextView addressTextView = convertView.findViewById(R.id.textView_adresse_client);
//        addressTextView.setText(client.getAddress());
//
//        TextView postalTextView = convertView.findViewById(R.id.textView_cp_client);
//        postalTextView.setText(client.getPostal());
//
//        TextView villeTextView = convertView.findViewById(R.id.textView_ville_client);
//        villeTextView.setText(client.getVille());
//
//        TextView telephoneTextView = convertView.findViewById(R.id.textView_tel_client);
//        telephoneTextView.setText(client.getTelephone());
//
//        TextView portableTextView = convertView.findViewById(R.id.textView_portable_client);
//        portableTextView.setText(client.getPortable());
//
//        TextView emailTextView = convertView.findViewById(R.id.textView_email_client);
//        emailTextView.setText(client.getEmail());
//
//
//        return convertView;
//    }
}
