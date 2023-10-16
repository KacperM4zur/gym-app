import React from 'react';
import {Navigate, useNavigate} from 'react-router-dom';
import './Home.css';

const isAuthenticated = () => {
    // Check if user information exists in local storage.
    const user = localStorage.getItem('user');
    return user !== null;
};

const Home = () => {
    const navigate = useNavigate();

    const handleLogout = () => {
        // Remove user information from local storage upon logout.
        localStorage.removeItem('user');

        // Navigate to the login page.
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
                {/* Add your home page content here */}
            </div>
        </div>
    );
};

export default Home;
