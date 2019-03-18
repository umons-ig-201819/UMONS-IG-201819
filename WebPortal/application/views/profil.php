<section>
	<h1>Mon profil</h1>
	<a href="<?=site_url("profil/remove/$user_id");?>">Supprimer mon profil</a>
	<article id="account_information">
		<?php
echo form_open("profil/update/$user_id");
echo form_fieldset('Donn&eacute;es personnelles');
echo '<p>';
    echo form_label('Nom','lastname');
    echo form_input('lastname',$lastname,'id="lastname"');
echo '</p>';
echo '<p>';
    echo form_label('Pr&eacute;nom','firstname');
    echo form_input('firstname',$firstname,'id="firstname"');
echo '</p>';
echo '<p>';
    echo form_label('Date de naissance','birthdate');
    echo '<input type="date" name="birthdate" value="'.$birthdate.'" id="birthdate">';// TODO check Y-m-d
echo '</p>';
echo '<p>';
    echo form_label('Sexe');
    echo form_radio('gender','1',$gender, 'id="gender_enabled"').form_label('Homme','gender_enabled');
    echo form_radio('gender','0',!$gender, 'id="gender_disabled"').form_label('Femme','gender_disabled');
    
    echo form_input('gender',$gender,'id="gender"');/*** TODO input type to radio (HTML5) **/
echo '</p>';
echo '<p>';
    echo form_label('Adresse email','email');// email
    echo '<input type="tel" name="email" value="'.$email.'" id="email">';
echo '</p>';
echo '<p>';
    echo form_label('T&eacute;l&eacute;phone','phone');
    echo '<input type="tel" name="phone" value="'.$phone.'" id="phone">';
echo '</p>';
echo '<p>';
    echo form_label('G.S.M.','mobile');
    echo '<input type="mobile" name="mobile" value="'.$mobile.'" id="mobile">';
echo '</p>';
echo '<p>';
    echo form_label('Login','username');
    echo form_input('username',$username,'id="username"'.($editable_login?'':' readonly="readonly"'));
echo '</p>';
echo form_submit('action', 'Modifier');

echo '<p>';
    echo '<a href="'.site_url("profil/password/$user_id").'">Modifier mon mot de passe</a>';
    echo '<a href="'.site_url("profil/data/$user_id").'">Modifier mon mot de passe</a>';
echo '</p>';

echo form_fieldset_close();
echo form_close();
		?>	
	</article>
	<article id="account_right">
		<?php
echo form_open("profil/rights/$user_id");
echo form_fieldset('Droits d\'acc&egrave;s');
echo '<p>';
    echo form_label('Partager mes sources de donn&eacute;es');
    echo form_radio('sharing','0',$sharing === 0, 'id="sharing_refuse"').form_label('Refuser','sharing_refuse');
    echo form_radio('sharing','2',$sharing === 1, 'id="sharing_request"').form_label('Demande d\'accord','sharing_request');
    echo form_radio('sharing','1',$sharing === 2, 'id="sharing_allow"').form_label('Autoriser','sharing_allow');
echo '</p>';
echo '<p>';
    echo form_label('Recevoir les requêtes d\'accès aux données (si le partage n\'est pas d\'office autorisé).');
    echo form_radio('advice','1',$advise, 'id="advise_enabled"').form_label('Accepter','advise_enabled');
    echo form_radio('advice','0',!$advise, 'id="advise_disabled"').form_label('Refuser','advise_disabled');
echo '</p>';
echo '<p>';
    echo form_label('En connaissance du R.G.P.D., j\'accepte que Wallesmart utilise mes données &agrave; des fins statistiques.');
    echo form_radio('gdpr','1',$gdpr, 'id="gdpr_enabled"').form_label('Accepter','gdpr_enabled');
    echo form_radio('gdpr','0',!$gdpr, 'id="gdpr_disabled"').form_label('Refuser','gdpr_disabled');
echo '</p>';
echo form_submit('action', 'Modifier');
echo form_fieldset_close();
echo form_close();
		?>
	</article>
</section>