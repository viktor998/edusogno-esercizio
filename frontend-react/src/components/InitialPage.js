import React from "react";
import { Link, useNavigate } from "react-router-dom";
import "./styles.css";


const InitialPage = () => {
  const navigate = useNavigate();
  const onRegisterBtn = () => {
    navigate('/register');
  }
  const onLoginBtn = () => {
    navigate('/login');
  }
  return (
    <header>
      <img className="logo" src="assets/img/logo.png" alt="" />
      <div>
        <button
          className="btn-common"
          style={{ marginRight: "20px" }}
          onClick={onRegisterBtn}
        >
          Register
        </button>
        <button
          className="btn-common"
          style={{ marginRight: "20px" }}
          onClick={onLoginBtn}
        >
          Login
        </button>
        {/* <button className="btn-common" style={{marginRight: '20px'}}>Logout</button> */}
      </div>
    </header>
  );
};

export default InitialPage;
