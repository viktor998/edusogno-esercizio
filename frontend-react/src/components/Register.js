import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
// import countryCode from "./CountryCodes.json";
import axios from "axios";

const Register = () => {
  const [formData, setFormData] = useState({
    firstName: "",
    lastName: "",
    email: "",
    password: "",
  });
  const navigate = useNavigate();
  const [serverStatus, setServerStatus] = useState(false);
  const [serverMsg, setServerMsg] = useState("");
  const [errors, setErrors] = useState({});
  const [isLoading, setIsLoading] = useState(false);
  // console.log(serverMsg);
  // console.log(serverMsg.message);
  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const validateForm = () => {
    let isValid = true;
    const newErrors = {};
    if (formData.firstName.length < 3) {
      newErrors.firstName = "First name should be at least 3 characters";
      isValid = false;
    }
    if (formData.lastName.length < 3) {
      newErrors.lastName = "Last name should be at least 3 characters";
      isValid = false;
    }
    const passwordPattern =
      /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{5,}$/;
    if (!passwordPattern.test(formData.password)) {
      newErrors.password =
        "Password should be at least 8 characters with 1 capital letter, 1 special character, and 1 number";
      isValid = false;
    }
    setErrors(newErrors);
    return isValid;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (validateForm()) {
      setIsLoading(true);
      try {
        const formDataToSend = new FormData();
        formDataToSend.append("firstName", formData.firstName);
        formDataToSend.append("lastName", formData.lastName);
        formDataToSend.append("email", formData.email);
        formDataToSend.append("password", formData.password);
        console.log(formDataToSend);
        const response = await axios.post(
          "http://localhost/edusogno/backend-php/registration.php",
          formDataToSend
        );

        setServerStatus(true);
        setServerMsg(response.data);
        navigate('/login');
        setIsLoading(false);
        setFormData({
          firstName: "",
          lastName: "",
          email: "",
          password: "",
        });
        setErrors({});
      } catch (error) {
        setIsLoading(false);
        console.log(error.message);
      }
    }
  };

  const onLoginBtn = () => {
    navigate('/login');
  }

  return (
    <>
      <header>
        <img className="logo" src="assets/img/logo.png" alt="" />
        <button className="btn-common" style={{marginRight: '20px'}} onClick={onLoginBtn}>accesso</button>
      </header>
      <div className="form">
        <h2 className="form-title">Crea il tuo account</h2>
        <form onSubmit={handleSubmit}>
          <div className="input-box">
            <label htmlFor="nome">Inserisci il nome</label>
            <input
              type="text"
              name="firstName"
              value={formData.firstName}
              onChange={handleChange}
              placeholder="Mario"
              id="nome"
              required
            />
          </div>
          {errors.firstName && <p className="error-msg">{errors.firstName}</p>}
          <div className="input-box">
            <label htmlFor="nome">Inserisci il cognome</label>
            <input
              type="text"
              name="lastName"
              value={formData.lastName}
              onChange={handleChange}
              placeholder="Rossi"
              id="cognome"
              required
            />
          </div>
          {errors.lastName && <p className="error-msg">{errors.lastName}</p>}
          <div className="input-box">
            <label htmlFor="nome">Inserisci la email</label>
            <input
              type="text"
              name="email"
              value={formData.email}
              onChange={handleChange}
              placeholder="name@example.com"
              id="email"
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
                value={formData.password}
                onChange={handleChange}
                id="password"
                placeholder="Scrivila qui"
                required
              />
              {/* <i className="fa-solid fa-eye " id="eye"></i> */}
            </div>
          </div>
          {errors.password && <p className="error-msg">{errors.password}</p>}
          <input className="btn" type="submit" value="registrati" />
          <p className="account">
            Hai già un account?{" "}
            <a href="/login">
              <strong>Accedi</strong>
            </a>{" "}
          </p>
        </form>
        {/* <Link to="/login">
        <p className="text-center mt-2">Already registered?</p>
      </Link> */}
      </div>
    </>
  );
};

export default Register;
