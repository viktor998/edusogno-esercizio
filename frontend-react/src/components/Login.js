import axios from "axios";
import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import { ThreeDots } from "react-loader-spinner";

const Login = () => {
  const [isLoading, setIsLoading] = useState(false);
  const [formData, setFormData] = useState({
    email: "",
    password: "",
  });
  const navigate = useNavigate();
  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };
  const [errors, setErrors] = useState({});

  const validateForm = () => {
    let isValid = true;
    const newErrors = {};
    // if (formData.email.length < 3) {
    //   newErrors.email = "First name should be at least 3 characters";
    //   isValid = false;
    // }
    // const passwordPattern =
    //   /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{5,}$/;
    // if (!passwordPattern.test(formData.password)) {
    //   newErrors.password =
    //     "Password should be at least 8 characters with 1 capital letter, 1 special character, and 1 number";
    //   isValid = false;
    // }
    setErrors(newErrors);
    return isValid;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    if (validateForm()) {
      try {
        const response = await axios.post("http://localhost/edusogno/backend-php/login.php", formData);

        const responseData = response.data;
        // setIsLoading(false);
        if (responseData.status === "success") {
          toast.success(responseData.message);

          setFormData({ email: "", password: "" });
          navigate("/dashboard");
          localStorage.setItem("user", JSON.stringify(responseData.user));
        } else {
          toast.error(responseData.message);
        }
      } catch (error) {
        toast.error("An error occurred");
      }
    }
  };

  const onRegisterBtn = () => {
    navigate('/register');
  }

  return (
    <>
      <header>
        <img className="logo" src="assets/img/logo.png" alt="" />
        <div>
          <button className="btn-common" style={{marginRight: '20px'}} onClick={onRegisterBtn}>registro</button>
          {/* <button className="btn-common" style={{marginRight: '20px'}}>Logout</button> */}
        </div>
      </header>
      <ToastContainer/>
      <div className="form">
        <h2 className="form-title">Hai già un account</h2>
        <form onSubmit={handleSubmit}>
          <div className="input-box">
            <label htmlFor="email">Inserisci la email</label>
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
          {errors.email && <p className="error-msg">{errors.email}</p>}
          <div className="input-box">
            <div>
              <label htmlFor="password">Inserisci la password</label>
            </div>
            <div className="password">
              <input
                type="password"
                name="password"
                id="password"
                placeholder=""
                value={formData.password}
                onChange={handleChange}
                required
              />
              {/* <i className="fa-solid fa-eye " id="eye"></i> */}
            </div>
          </div>
          {errors.password && <p className="error-msg">{errors.password}</p>}
          <a href="/reset-pass">Has olvidado tu contraseña?</a>
          {/* <div className="text-center">
          <button className="btn btn-primary mt-4" type="submit">
            {isLoading ? (
              <ThreeDots type="Oval" color="#fff" height={20} width={20} />
            ) : (
              "Login"
            )}
          </button>
        </div> */}
          <input className="btn" type="submit" value="Accedi" />
          <p className="account">
            Non hai ancora un profilo?{" "}
            <a href="/register">
              <strong>Registrati</strong>
            </a>{" "}
          </p>
        </form>
      </div>
    </>
  );
};

export default Login;
