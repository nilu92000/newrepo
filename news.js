function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    

    
    fetch('credentials.json')
        .then(response => response.json())
        .then(credentials => {
            if (credentials[username] === password) {
                document.getElementById("error-message").innerText = "";
                displayWelcomeMessage();
            } else {
                document.getElementById("error-message").innerText = "Invalid username or password. Please try again.";
            }
        })
        .catch(error => console.error('Error reading credentials:', error));
}

function displayWelcomeMessage(username) {
    document.body.innerHTML = ''; 
    


    var welcomeMessage = document.createElement('div');
    welcomeMessage.innerHTML = `
        <h1>
        <link href="https://cdn.jsdelivr.net/npm/emoji.css@3.0.1@/emoji.min.css" rel="stylesheet"/>Welcome 
        <br>Succssfully login..... </h1>
        <div class="smiley"></div>
        

        
        
    `;
  
    welcomeMessage.style.textAlign = 'center';
    welcomeMessage.style.marginTop = '90px';
    welcomeMessage.style.color = 'white,green'; // Set the text color to green
    welcomeMessage.style.fontStyle='italic';
    welcomeMessage.style.fontWeight = "900";
    welcomeMessage.style.fontSize = "x-large";


    document.body.appendChild(welcomeMessage);
     document.body.style.background ='url("3.jpg") center/cover no-repeat';
     
}
