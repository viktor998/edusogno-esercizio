import axios from "axios";
import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const Login = () => {
    const [formData, setFormData] = useState({
        new_pass: "",
        confirmpassword: ""
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
        const token = window.location.search.split('token=')[1];

        try {
            const response = await axios.post("http://localhost/edusogno/backend-php/new-pass.php", { ...formData, token: token });

            const responseData = response.data;
            if (responseData.status === "success") {
                toast.success(responseData.message);

                setFormData({ new_pass: "", confirmpassword: "" });
                navigate('/login');
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
                <h2 className="form-title">Crea nuova Password</h2>
                <form onSubmit={handleSubmit}>
                    <div className="input-box">
                        <label htmlFor="email">Inserisci la nuova password</label>
                        <input
                            type="password"
                            name="new_pass"
                            id="password"
                            placeholder=""
                            value={formData.new_pass}
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <div className="input-box">
                        <label htmlFor="email">confirmar la contraseña</label>
                        <input
                            type="password"
                            name="confirmpassword"
                            id="confirmpassword"
                            placeholder=""
                            value={formData.confirmpassword}
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <input className="btn" type="submit" value="Cambia Password" />
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
