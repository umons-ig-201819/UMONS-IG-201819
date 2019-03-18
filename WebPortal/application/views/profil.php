<section>
	<h1>Mon profil</h1>
	<a href="<?=site_url('profil/remove');?>">Supprimer mon profil</a>
	<article id="account_information">
		<?php
echo form_open('profil/update');
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
    echo form_label('Sexe','gender');
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
    echo form_input('username',$username,'id="username" readonly="readonly"');
echo '</p>';
echo form_submit('action', 'Modifier');

echo '<p>';
    echo '<a href="'.site_url('profil/password').'">Modifier mon mot de passe</a>';
    echo '<a href="'.site_url('profil/data').'">Modifier mon mot de passe</a>';
echo '</p>';

echo form_fieldset_close();
echo form_close();
		?>	
	</article>
	<article id="account_right">
		<?php
echo form_open('profil/rights');
echo form_fieldset('Droits d\'acc&egrave;s');
echo '<p>';
    echo form_label('Autoriser les &eacute;leveurs/agriculteurs &agrave; visualiser mes données&nbsp;?','farmer_enabled');
    echo form_radio('farmer','1',$farmer, 'id="farmer_enabled"');
    echo form_radio('farmer','0',!$farmer, 'id="farmer_disabled"');
echo '</p>';
echo '<p>';
    echo form_label('Autoriser les conseillers &agrave; visualiser mes donn&eacute;es&nbsp;?','advisor_enabled');
    echo form_radio('advisor','1',$advisor, 'id="advisor_enabled"');
    echo form_radio('advisor','0',!$advisor, 'id="advisor_disabled"');
echo '</p>';
echo '<p>';
    echo form_label('Autoriser les scientifiques &agrave; visualiser mes donn&eacute;es&nbsp;?','scientist_enabled');
    echo form_radio('scientist','1',$scientist, 'id="scientist_enabled"');
    echo form_radio('scientist','0',!$scientist, 'id="scientist_disabled"');
echo '</p>';
echo '<p>';
    echo form_label('En connaissance du R.G.P.D., j\'accepte que Wallesmart utilise mes données &agrave; des fins statistiques.','gdpr_enabled');
    echo form_radio('gdpr','1',$gdpr, 'id="gdpr_enabled"');
    echo form_radio('gdpr','0',!$gdpr, 'id="gdpr_disabled"');
echo '</p>';
echo form_submit('action', 'Modifier');
echo form_fieldset_close();
echo form_close();
		?>
	</article>
</section>