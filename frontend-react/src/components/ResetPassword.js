import axios from "axios";
import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const Login = () => {
    const [formData, setFormData] = useState({
        email: "",
    });
    const navigate = useNavigate();
    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value,
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post("http://localhost/edusogno/backend-php/reset-pass.php", formData);

            const responseData = response.data;
            if (responseData.status === "success") {
                toast.success(responseData.message);

                setFormData({ email: "" });
            } else {
                toast.error(responseData.message);
            }
        } catch (error) {
            toast.error("An error occurred");
        }
    };

    const onLoginBtn = () => {
        navigate('/register');
    }


    return (
        <>
            <header>
                <img className="logo" src="assets/img/logo.png" alt="" />
                <button className="btn-common" style={{ marginRight: '20px' }} onClick={onLoginBtn}>Login</button>
            </header>
            <ToastContainer />
            <div className="form">
                <h2 className="form-title">Recupero Password</h2>
                <form onSubmit={handleSubmit}>
                    <div className="input-box">
                        <label htmlFor="email">inserisci l'e-mail</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            placeholder="name@example.com"
                            value={formData.email}
                            onChange={handleChange}
                            required
                        />
                    </div>

                    <input className="btn" type="submit" value="Accedi" />
                    <p className="account">
                        <a href="/login">
                            <strong>Espalda</strong>
                        </a>{" "}
                    </p>
                </form>
            </div>
        </>
    );
};

export default Login;
