var app = {
  init: function() {
    console.log('init');

    const signInButtonElement= document.querySelector('connexion-button');
   console.log(signInButtonElement);

  },
  handleSignIn: function (evt){
    console.log('I want sign in')
  },


  
};

$(app.init);



