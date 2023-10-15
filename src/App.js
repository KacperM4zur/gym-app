import './App.css';
import {BrowserRouter as Router, Route, Routes} from "react-router-dom";
import LoginSignup from "./Components/LoginSignup/LoginSignup";
import Home from "./Components/HomePage/Home";


function App() {
  return (
    <div>
        <LoginSignup/>
        <Home/>
    </div>
  );
}

export default App;
