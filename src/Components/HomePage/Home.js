import React from 'react';
import {Navigate, useNavigate} from 'react-router-dom';
import './Home.css';

const isAuthenticated = () => {
    const user = localStorage.getItem('user');
    return user !== null;
};

const Home = () => {
    const navigate = useNavigate();

    const handleLogout = () => {
        localStorage.removeItem('user');
        navigate('/login');
    };

    if (!isAuthenticated()) {
        return <Navigate to="/login" />;
    }

    return (
        <div className="home">
            <div className="center-content">
                <h1>Welcome to the Home Page</h1>
                <button onClick={handleLogout}>Logout</button>
            </div>
        </div>
    );
};

export default Home;
