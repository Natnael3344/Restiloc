package fr.driss_soudani.ds_restiloc;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.List;

public class ExpertListAdapter extends BaseAdapter {
    private Context mContext;
    private List<Expert> mExpertList;
    public ExpertListAdapter(Context context, List<Expert> expertList) {
        mContext = context;
        mExpertList = expertList;
    }

    @Override
    public int getCount() {
        return mExpertList.size();
    }

    @Override
    public Object getItem(int position) {
        return mExpertList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            LayoutInflater inflater = LayoutInflater.from(mContext);
            convertView = inflater.inflate(R.layout.activity_list_expert, null);
        }

        Expert expert = mExpertList.get(position);

        TextView nameTextView =  convertView.findViewById(R.id.textView_nom_expert);
        nameTextView.setText(expert.getName());

        TextView foreTextView = convertView.findViewById(R.id.textView_prenom_expert);
        foreTextView.setText(expert.getPreNom());

        TextView telTextView = convertView.findViewById(R.id.textView_tel_expert);
        telTextView.setText(expert.getTelephone());

        TextView emailTextView = convertView.findViewById(R.id.textView_mail_expert);
        emailTextView.setText(expert.getMail());


        return convertView;
    }
}
