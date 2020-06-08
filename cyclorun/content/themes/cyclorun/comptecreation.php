<?php
/**
 * Template Name: Registration-Form-Cris
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	@import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,500&display=swap');

* {
	box-sizing: border-box;
}

body {
	background-image: url('../assets/images/cycl/cycl2.jpg'),  url('../assets/images/run/run2.jpg');
    background-size: 50%;
	background-repeat: no-repeat, no-repeat;
    background-position: left, right;
	font-family: 'Open Sans', sans-serif;
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 100vh;
	margin: 0;
}

.container {

	border-radius: 5px;
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
	overflow: hidden;
}

.header {
	border-bottom: 1px solid #f0f0f0;
	background-color: #f7f7f7;
	padding: 20px 40px;
}

.header h2 {
	margin: 0;
}

.form {
	padding: 30px 40px;	
}

.form-control {
	margin-bottom: 10px;
	padding-bottom: 20px;
	position: relative;
}

.form-control label {
	display: inline-block;
	margin-bottom: 5px;
}

.form-control input {
	border: 2px solid #f0f0f0;
	border-radius: 4px;
	display: block;
	font-family: inherit;
	font-size: 14px;
	padding: 10px;
	width: 100%;
}

.form-control input:focus {
	outline: 0;
	border-color: #777;
}

.form-control.success input {
	border-color: #2ecc71;
}

.form-control.error input {
	border-color: #e74c3c;
}

.form-control i {
	visibility: hidden;
	position: absolute;
	top: 40px;
	right: 10px;
}

.form-control.success i.fa-check-circle {
	color: #2ecc71;
	visibility: visible;
}

.form-control.error i.fa-exclamation-circle {
	color: #e74c3c;
	visibility: visible;
}

.form-control small {
	color: #e74c3c;
	position: absolute;
	bottom: 0;
	left: 0;
	visibility: hidden;
}

.form-control.error small {
	visibility: visible;
}

.form button {
	background-color: #8e44ad;
	border: 2px solid #8e44ad;
	border-radius: 4px;
	color: #fff;
	display: block;
	font-family: inherit;
	font-size: 16px;
	padding: 10px;
	margin-top: 20px;
	width: 100%;
}
	</style>
	
	
</head>
<body>
<title>Inscription Form</title>
<div class="container">
	<div class="header">
		<h2>Inscription</h2>
	</div>
	<form id="form" class="form">
		<div class="form-control">
			<label for="username">Nom</label>
			<input type="text" placeholder="Nom" id="username" />
			<i class="fas fa-check-circle"></i>
			<i class="fas fa-exclamation-circle"></i>
			<small>Error message</small>
        </div>
        
        <div class="form-control">
			<label for="username">Prenom</label>
			<input type="text" placeholder="Prenom" id="username" />
			<i class="fas fa-check-circle"></i>
			<i class="fas fa-exclamation-circle"></i>
			<small>Error message</small>
        </div>

        <div class="form-control">
                <label class="inscription__form__label__birthdate" for="birthdate">Date de naissance</label>
                <div class="birthdate">
                    <input class="inscription__form__input__birthdate" type="text" name="day_birth" id="day_birth" value="" placeholder="JJ/MM/AAAA"/>

                </div>
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
        </div>

        <div class="from-control">
                <div class="existing-prof-pic-cont"></div>
                <label class="inscription__form__label" for="user_profile_pic">Avatar</label>
                    <input type="file" name="user_profile_pic" id="user_profile_pic" />
                
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>
                
        
		<div class="form-control">
			<label for="username">Email</label>
			<input type="email" placeholder="john@doe.com" id="email" />
			<i class="fas fa-check-circle"></i>
			<i class="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
		<div class="form-control">
			<label for="username">Mot de passe</label>
			<input type="password" placeholder="mot de passe" id="password"/>
			<i class="fas fa-check-circle"></i>
			<i class="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
		<div class="form-control">
			<label for="username">Confirmer le mot de passe</label>
			<input type="password" placeholder="Confirmer le mot de passe" id="password2"/>
			<i class="fas fa-check-circle"></i>
			<i class="fas fa-exclamation-circle"></i>
			<small>Error message</small>
        </div>
        <div class="form-control">
                <label class="inscription__form__label" for="address"> Adresse Postale</label>
                    <textarea class="inscription__form__input" name="address" id="address" value=""></textarea>
                
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>
        <div class="form-control">
                <label class="inscription__form__label" for="postcode"> Code Postal</label>
                    <input class="inscription__form__input" type="text" name="postcode" id="postcode" value=""/>
                
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>

                <div class="form-control">
                <label class="inscription__form__label" for="city"> Ville</label>
                    <input class="inscription__form__input" type="text" name="city" id="city" value=""/>
                
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>

        </div>

        <div class="custom-control control-form custom-switch inscription__form__select">
                        <input class="inscription__form__input custom-control-input" type="checkbox" name="cycling" value="cycling" id="cycling">
                        <label class="inscription__form__label custom-control-label" for="cycling">Vélo</label>
                        <label class="inscription__form__label mr-sm-2 sr-only" for="cycling-level">Mon Niveau</label>
                            <select class="custom-select mr-sm-2" name="cycling_level" id="cycling_level_select">
                                <option value="" selected>Choisir</option>
                                <option value="loisirs">Loisirs (inferieur à 15km/sortie)</option>
                                <option value="regulier">Régulier (15-30 km)</option>
                                <option value="avance">Avancé (30-60 km)</option>
                                <option value="intensif">Intensif (+60 km)</option>
                            </select>
                            <i class="fa fa-check-circle"></i>
                            <i class="fa fa-exclamation-circle"></i>
                            <small>Error Message</small>
                        
        </div>

        <div class="custom-controlcontrol-form custom-switch inscription__form__select">
                        <input class="inscription__form__input custom-control-input" type="checkbox" name="running" value="running" id="running">
                        <label class="inscription__form__label custom-control-label" for="running">Running</label>
                        <label class="inscription__form__label mr-sm-2 sr-only" for="running_level">Mon Niveau </label>
                        <select class="custom-select mr-sm-2" name="running_level" id="running_level_select">
                            <option value="" selected>Choisir</option>
                            <option value="loisirs">Loisirs (inferieur à 15km/sortie)</option>
                            <option value="regulier">Régulier (15-30 km)</option>
                            <option value="avance">Avancé (30-60 km)</option>
                            <option value="intensif">Intensif (+60 km)</option>
                        </select>
                        <i class="fa fa-check-circle"></i>
                            <i class="fa fa-exclamation-circle"></i>
                            <small>Error Message</small>
                    </div>
		<button>Submit</button>
	</form>
</div>
</body>
<script>
	const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

form.addEventListener('submit', e => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs() {
	// trim to remove the whitespaces
	const usernameValue = username.value.trim();
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();
	const password2Value = password2.value.trim();
	
	if(usernameValue === '') {
		setErrorFor(username, 'Username cannot be blank');wp/wp-admin/
	} else {
		setSuccessFor(username);
	}
	
	if(emailValue === '') {
		setErrorFor(email, 'Remplis le champ email');
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'Email non valide');
	} else {
		setSuccessFor(email);
	}
	
	if(passwordValue === '') {
		setErrorFor(password, 'Remplir ce champ');
	} else {
		setSuccessFor(password);
	}
	
	if(password2Value === '') {
		setErrorFor(password2, 'Remplir ce champ');
	} else if(passwordValue !== password2Value) {
		setErrorFor(password2, 'Mot de passe non valide');
	} else{
		setSuccessFor(password2);
	}
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}
	
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

</script>
</html>
