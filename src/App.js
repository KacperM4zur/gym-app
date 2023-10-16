import './App.css';
import {BrowserRouter as Router, Route, Routes} from "react-router-dom";
import LoginSignup from "./Components/LoginSignup/LoginSignup";
import Home from "./Components/HomePage/Home";


function App() {
    return (
        <Router>
            <Routes>
                <Route path="/login" element={<LoginSignup />} />
                <Route path="/" element={<Home />} />
            </Routes>
        </Router>
    );
}

export default App;
