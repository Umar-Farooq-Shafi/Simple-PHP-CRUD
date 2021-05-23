const submitForm = () => {
    
    const pass = document.getElementById('pass').value;
    const re_pass = document.getElementById('re_pass').value;

    if (pass === re_pass) {        
        return true;
    }else {
        event.preventDefault();
        alert('Password not match');
        return false;
    }
}