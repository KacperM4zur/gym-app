// import React, { useState } from "react";
// import './LoginSignup.css'
//
// import user_icon from '../Assets/person.png'
// import email_icon from '../Assets/email.png'
// import password_icon from '../Assets/password.png'
//
// const LoginSignup = () => {
//     const [action, setAction] = useState("Sign Up");
//     const [formData, setFormData] = useState({
//         name: '',
//         email: '',
//         password: ''
//     });
//
//     const handleSubmit = async (e) => {
//         e.preventDefault();
//
//         try {
//             if (action === "Login") {
//                 const response = await fetch('http://gymappbo.westeurope.cloudapp.azure.com/api/login', { // Zastąp to odpowiednim endpointem API logowania
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/json'
//                     },
//                     body: JSON.stringify(formData)
//                 });
//
//                 if (response.ok) {
//                     const responseData = await response.json();
//                     if (responseData.status === 200 && responseData.message === "Successfully logged in") {
//                         // Pomyślnie zalogowano
//                         console.log("Zalogowano pomyślnie. Dane użytkownika:", responseData.data);
//                         // Tutaj możesz wykonać odpowiednie akcje, na przykład przekierowanie na inną stronę.
//                     } else {
//                         console.log("Błąd logowania: ", responseData.message);
//                     }
//                 } else if (response.status === 400) {
//                     // Obsługa błędu 400
//                     console.log("Błąd 400 - Nieprawidłowe dane.");
//                 } else {
//                     console.log("Inny błąd HTTP: ", response.status);
//                 }
//             } else if (action === "Sign Up") {
//                 const response = await fetch('http://adres-twojego-api/register', { // Zastąp to odpowiednim endpointem API rejestracji
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/json'
//                     },
//                     body: JSON.stringify(formData)
//                 });
//
//                 if (response.ok) {
//                     alert("Rejestracja udana!");
//                 } else {
//                     alert("Rejestracja nie powiodła się. Sprawdź dane lub istniejące konto.");
//                 }
//             }
//         } catch (error) {
//             console.error("Błąd: ", error);
//             alert("Wystąpił błąd. Spróbuj ponownie później.");
//         }
//     };
//
//     return (
//         <div className='container'>
//             <form onSubmit={handleSubmit}>
//                 <div className="header">
//                     <div className="text">{action}</div>
//                     <div className="underline"></div>
//                 </div>
//                 <div className="inputs">
//                     {action === "Login" ? <div></div> : (
//                         <div className="input">
//                             <img src={user_icon} alt=""/>
//                             <input
//                                 type="text"
//                                 placeholder="Name"
//                                 value={formData.name}
//                                 onChange={(e) => setFormData({ ...formData, name: e.target.value })}
//                             />
//                         </div>
//                     )}
//                     <div className="input">
//                         <img src={email_icon} alt=""/>
//                         <input
//                             type="email"
//                             placeholder="Email"
//                             value={formData.email}
//                             onChange={(e) => setFormData({ ...formData, email: e.target.value })}
//                         />
//                     </div>
//                     <div className="input">
//                         <img src={password_icon} alt=""/>
//                         <input
//                             type="password"
//                             placeholder="Password"
//                             value={formData.password}
//                             onChange={(e) => setFormData({ ...formData, password: e.target.value })}
//                         />
//                     </div>
//                 </div>
//                 {action === "Sign Up" ? <div></div> : (
//                     <div className="forgot-password">Lost password? <span>Click Here!</span></div>)}
//                 <div className="submit-container">
//                     {/*<div className={action === "Login" ? "submit gray" : "submit"} onClick={() => {*/}
//                     {/*    setAction("Sign Up")*/}
//                     {/*}}>Sign Up*/}
//                     {/*<button type="submit" className={action === "Sign Up" ? "submit gray" : "submit"} onClick={() => {*/}
//                     {/*    setAction("Sign Up")}}>Sign Up</button>*/}
//                     {/*</div>*/}
//                     {/*<div className={action === "Sign Up" ? "submit gray" : "submit"} onClick={() => {*/}
//                     {/*    setAction("Login")}}>Login*/}
//                         <button type="submit" className={action === "Sign Up" ? "submit gray" : "submit"} onClick={() => {
//                             setAction("Login")}}>Login</button>
//                     {/*</div>*/}
//                 </div>
//             </form>
//         </div>
//     );
// }
//
// export default LoginSignup;


import React, { useState } from "react";
import {Route, Routes, Navigate, Router, useNavigate} from "react-router-dom";
import './LoginSignup.css'
import user_icon from '../Assets/person.png'
import email_icon from '../Assets/email.png'
import password_icon from '../Assets/password.png'

const isAuthenticated = () => {
    const user = localStorage.getItem('user');
    return user !== null;
};

const LoginSignup = () => {
    const [action, setAction] = useState("Sign Up");
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        password: ''
    });

    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            if (action === "Login") {
                const response = await fetch('http://gymappbo.westeurope.cloudapp.azure.com/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    const responseData = await response.json();
                    if (responseData.status === 200 && responseData.message === "Successfully logged in") {
                        console.log("Successfully logged in. User data:", responseData.data);
                        localStorage.setItem('user', JSON.stringify(responseData.data));
                        navigate('/');
                    } else {
                        console.log("Login error: ", responseData.message);
                    }
                } else if (response.status === 400) {
                    console.log("Error 400 - Invalid data.");
                } else {
                    console.log("Other HTTP error: ", response.status);
                }
            } else if (action === "Sign Up") {
                const response = await fetch('http://adres-twojego-api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    alert("Registration successful!");
                } else {
                    alert("Registration failed. Check your data or existing account.");
                }
            }
        } catch (error) {
            console.error("Error: ", error);
            alert("An error occurred. Please try again later.");
        }
    };

    const handleLogout = () => {
        localStorage.removeItem('user');
    };

    return (
        <div className='container'>
            {isAuthenticated() ? (
                <div>
                    <div>{JSON.parse(localStorage.getItem('user')).name}</div>
                    <button onClick={handleLogout}>Logout</button>
                </div>
            ) : (
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
                                    onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                                />
                            </div>
                        )}
                        <div className="input">
                            <img src={email_icon} alt=""/>
                            <input
                                type="email"
                                placeholder="Email"
                                value={formData.email}
                                onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                            />
                        </div>
                        <div className="input">
                            <img src={password_icon} alt=""/>
                            <input
                                type="password"
                                placeholder="Password"
                                value={formData.password}
                                onChange={(e) => setFormData({ ...formData, password: e.target.value })}
                            />
                        </div>
                    </div>
                    {action === "Sign Up" ? <div></div> : (
                        <div className="forgot-password">Lost password? <span>Click Here!</span></div>)}
                    <div className="submit-container">
                        <button type="submit" className={action === "Sign Up" ? "submit gray" : "submit"} onClick={() => {
                            setAction("Login")
                        }}>Login</button>
                    </div>
                </form>
            )}
        </div>
    );
};

export default LoginSignup;