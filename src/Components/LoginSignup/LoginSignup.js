import React, {useState} from "react";
import './LoginSignup.css'

import user_icon from '../Assets/person.png'
import email_icon from '../Assets/email.png'
import password_icon from '../Assets/password.png'

const LoginSignup = () => {
    const [action, setAction] = useState("Sign Up");
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        password: ''
    });

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            if (action === "Login") {
                const response = await fetch('/api/login', { // Zastąp to odpowiednim endpointem API logowania
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    alert("Logowanie udane!");
                } else {
                    alert("Logowanie nie powiodło się. Sprawdź dane logowania.");
                }
            } else if (action === "Sign Up") {
                const response = await fetch('/api/register', { // Zastąp to odpowiednim endpointem API rejestracji
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    alert("Rejestracja udana!");
                } else {
                    alert("Rejestracja nie powiodła się. Sprawdź dane lub istniejące konto.");
                }
            }
        } catch (error) {
            console.error("Błąd: ", error);
            alert("Wystąpił błąd. Spróbuj ponownie później.");
        }
    };

    return (
        <div className='container'>
            <form onSubmit={handleSubmit}>
                <div className="header">
                    <div className="text">{action}</div>
                    <div className="underline"></div>
                </div>
                <div className="inputs">
                    {action === "Login" ? <div></div> : (
                        <div className="input">
                            <img src={user_icon} alt=""/>
                            <input
                                type="text"
                                placeholder="Name"
                                value={formData.name}
                                onChange={(e) => setFormData({...formData, name: e.target.value})}
                            />
                        </div>
                    )}
                    <div className="input">
                        <img src={email_icon} alt=""/>
                        <input
                            type="email"
                            placeholder="Email"
                            value={formData.email}
                            onChange={(e) => setFormData({...formData, email: e.target.value})}
                        />
                    </div>
                    <div className="input">
                        <img src={password_icon} alt=""/>
                        <input
                            type="password"
                            placeholder="Password"
                            value={formData.password}
                            onChange={(e) => setFormData({...formData, password: e.target.value})}
                        />
                    </div>
                </div>
                {action === "Sign Up" ? <div></div> : (
                    <div className="forgot-password">Lost password? <span>Click Here!</span></div>)}
                <div className="submit-container">
                    <div className={action === "Login" ? "submit gray" : "submit"} onClick={() => {
                        setAction("Sign Up")
                    }}>Sign Up
                    </div>
                    <div className={action === "Sign Up" ? "submit gray" : "submit"} onClick={() => {
                        setAction("Login")
                    }}>Login
                    </div>
                </div>
            </form>
        </div>
    );
}

export default LoginSignup;
