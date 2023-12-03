import React from "react";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import Menu from "./Components/Menu/Menu";
import LoginSignup from "./Components/LoginSignup/LoginSignup";
import Home from "./Components/HomePage/Home";
import Contact from "./Components/Contact/Contact"

function App() {
    return (
        <Router>
            <Menu /> {/* Dodaj komponent Menu na samej górze aplikacji qweq*/}
            <Routes>
                <Route path="/login" element={<LoginSignup />} />
                <Route path="/" element={<Home />} />
                <Route path="/contact" element={<Contact />} /> {/* Dodaj komponent Contact do routów */}
            </Routes>
        </Router>
    );
}

export default App;
