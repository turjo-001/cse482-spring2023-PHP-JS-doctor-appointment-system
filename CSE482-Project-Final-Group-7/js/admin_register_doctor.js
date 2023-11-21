document.getElementById('anchor-nav-home').addEventListener('click', function(){
    window.location.href='admin_homePage.php';
})

document.getElementById('btn-registration-submit').addEventListener('click', function(){

const firstNameField=document.getElementById('registration-firstName');
const firstName=firstNameField.value;

const lastNameField=document.getElementById('registration-lastName');
const lastName=lastNameField.value;

const specializationField =document.getElementById('registration-specialization');
const specialization =specializationField.value;

const emailField =document.getElementById('registration-emailAddress');
const email =emailField.value;

const phoneField =document.getElementById('registration-phoneNumber');
const phone =phoneField.value;

const passwordField =document.getElementById('registration-password');
const password =passwordField.value;

const NewPasswordField =document.getElementById('registration-new-password');
const NewPassword =NewPasswordField.value;




if(firstName === null || firstName.length < 3 || lastName === null || lastName.length < 3){

    alert("Enter the name correctly.")
    
}

if( (typeof firstName !== "string")  || (typeof lastName !== "string" ) ){
    alert("Name cannot contain number.")    
    }


if(specialization=== null){
    alert("Enter doctors specialization.")
}
if(email===null){
    alert("Enter doctors email address.")
}

if(phone.length< 11 || typeof phone === "string"){
    alert("Enter the phone number");
}

if(password.length<5){
    alert("Enter password");
}

if(password!=NewPassword){
    alert("Re-enter the password correctly")
}


})


