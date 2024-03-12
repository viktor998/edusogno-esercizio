import axios from "axios";
import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { ToastContainer, toast } from "react-toastify";
import Modal from "react-modal";

const Home = () => {
  const api = "http://localhost/edusogno/backend-php/eventController/";
  const storedUser = localStorage.getItem("user");
  const [events, setEvents] = useState([]);
  const user = storedUser ? JSON.parse(storedUser) : null;
  const [isCreateModalOpen, setIsCreateModalOpen] = useState(false);

  const [createData, setCreateData] = useState({
    id: 0,
    attendees: "",
    nome_evento: "",
    data_evento: "",
  });

  const navigate = useNavigate();
  const [updateData, setUpdateData] = useState({
    id: 0,
    attendees: "",
    nome_evento: "",
    data_evento: "",
  });
  const [isModalOpen, setIsModalOpen] = useState(false);

  useEffect(() => {
    getEvents();
  }, []);

  const onLogoutClick = () => {
    navigate("/login");
  };

  const getEvents = async () => {
    await axios
      .get(api + `getEvent.php?email=${user.email}`)
      .then((res) => {
        setEvents(res.data);
        console.log(res.data);
      })
      .catch((error) => {
        console.error("Error fetching events:", error);
      });
  };

  const deleteEvent = async (event_id) => {
    try {
      console.log(api + "deleteEvent.php", { event_id: event_id });
      await axios.post(api + "deleteEvent.php", { event_id }).then((res) => {
        toast.success(res.data.message);
      });
    } catch (error) {
      console.log("Error deleting event: ", error);
    }
  };

  const openUpdateModal = (item) => {
    setUpdateData({
      event_id: item.id,
      attendees: item.attendees,
      nome_evento: item.nome_evento,
      data_evento: item.data_evento,
    });
    setIsModalOpen(true);
  };

  const handleUpdateChange = (e) => {
    setUpdateData({
      ...updateData,
      [e.target.name]: e.target.value,
    });
    console.log(updateData);
  };

  const updateEvent = async () => {
    try {
      await axios.post(api + "updateEvent.php", {
        event_id: updateData.event_id,
        attendees: updateData.attendees,
        nome_evento: updateData.nome_evento,
        data_evento: updateData.data_evento,
      }).then((res) => {
        toast.success("successfully updated.");
      });
      getEvents();
      setUpdateData({
        id: 0,
        attendees: "",
        nome_evento: "",
        data_evento: "",
      });
      closeModal();
    } catch (error) {
      console.error("Error updating event: ", error);
    }
  };

  const closeModal = () => {
    setIsModalOpen(false);
  };

  const closeCreateModal = () => {
    setIsCreateModalOpen(false);
  };

  const createEvent = async () => {
    try {
      if(createData.attendees == "" || createData.nome_evento == "" || createData.data_evento == "") {
        toast.warning("all the fields should be filled.");
        return;
      }
      await axios.post(api + "createEvent.php", {
        event_id: createData.event_id,
        attendees: createData.attendees,
        nome_evento: createData.nome_evento,
        data_evento: createData.data_evento,
      })
      .then((res) => {
          toast.success("new Event created succesfully.");
      });
      getEvents();
      setCreateData({
        id: 0,
        attendees: "",
        nome_evento: "",
        data_evento: "",
      });
      closeCreateModal();
    } catch (error) {
      console.error("Error updating event: ", error);
    }
  };

  const splitAttendee = (attendee) => {
    let result;
    if (attendee !== "" || attendee !== null) {
      const arrs = attendee.split(",");
      arrs.map((arr) => {
        result = arrs.map((arr) => `<span>${arr}</span><br/>`).join("");
      });
    }
    return result;
  };

  const handleCreateChange = (e) => {
    setCreateData({
      ...createData,
      [e.target.name]: e.target.value,
    });
  };

  const openCreateModal = () => {
    setCreateData({
      event_id: 0,
      attendees: "",
      nome_evento: "",
      data_evento: "",
    });
    setIsCreateModalOpen(true);
  };

  return (
    <>
      <ToastContainer />
      <header>
        <img className="logo" src="assets/img/logo.png" alt="" />
        <button
          className="btn-common"
          style={{ marginRight: "20px" }}
          onClick={onLogoutClick}
        >
          Logout
        </button>
      </header>
      {user.role == "admin" ? (
        <div className="admin-table">
          <h2 style={{ textAlign: "left", color: "blue" }}>Pannello di amministrazione</h2>
          <table className="table table-dark table-hover text-start">
            <thead>
              <tr>
                <th>No</th>
                <th>Nome_evento</th>
                <th>Data_evento</th>
                <th>Partecipanti</th>
                <th><button className="btn-common-edit" onClick={openCreateModal}>Creare</button></th>
              </tr>
            </thead>
            <tbody>
              {events.length === 0 ? (
                <tr>
                  <td colSpan="6">
                    <h1 className="text-center">Nessun evento</h1>
                  </td>
                </tr>
              ) : (
                events.map((item, index) => (
                  <tr key={index}>
                    <td>{index + 1}</td>
                    <td>{item.nome_evento}</td>
                    <td>{item.data_evento}</td>
                    {/* <td className="attende">{splitAttendee(item.attendees)}</td> */}
                    <td
                      dangerouslySetInnerHTML={{
                        __html: splitAttendee(item.attendees),
                      }}
                    ></td>
                    <td>
                      <button
                        className="btn-common-edit"
                        style={{ marginRight: "5px" }}
                        onClick={() => openUpdateModal(item)}
                      >
                        Aggiornamento
                      </button>
                      <button
                        className="btn-common-delete"
                        onClick={() => deleteEvent(item.id)}
                      >
                        Cancellare
                      </button>
                    </td>
                  </tr>
                ))
              )}
            </tbody>
          </table>

          <Modal
            isOpen={isModalOpen}
            onRequestClose={closeModal}
            contentLabel="Update Event"
            className="modal-container"
          >
            <h2>Aggiornamento evento</h2>
            <input
              type="hidden"
              readOnly
              name="event_id"
              id="event_id"
              value={updateData.event_id}
            />
            <div className="input-group">
              <label htmlFor="nome_evento">
                <b>nome_evento</b>
                <br />
              </label>
              <input
                type="text"
                name="nome_evento"
                id="nome_evento"
                className="form-control"
                value={updateData.nome_evento}
                onChange={handleUpdateChange}
                required
              />
            </div>
            <div className="input-group">
              <label htmlFor="attendees">
                <b>partecipanti</b>
                <br />
              </label>
              <input
                type="text"
                name="attendees"
                id="attendees"
                className="form-control"
                value={updateData.attendees}
                onChange={handleUpdateChange}
                required
              />
            </div>
            <div className="form-group">
              <label htmlFor="data_evento">
                <b>data_evento</b>
                <br />
              </label>
              <input
                type="datetime-local"
                name="data_evento"
                id="data_evento"
                className="form-control"
                value={updateData.data_evento}
                onChange={handleUpdateChange}
                required
              />
            </div>
            <div className="btns">
              <button
                type="button"
                className="btn-common-edit"
                onClick={updateEvent}
              >
                Salva le modifiche
              </button>
              <button
                type="button"
                className="btn-common-delete"
                onClick={closeModal}
              >
                Annullamento
              </button>
            </div>
          </Modal>

          <Modal
            isOpen={isCreateModalOpen}
            onRequestClose={closeCreateModal}
            contentLabel="Create Event"
            className="modal-container"
          >
            <h2>Crea evento</h2>
            <input
              type="hidden"
              readOnly
              name="event_id"
              id="event_id"
              value={createData.event_id}
            />
            <div className="input-group">
              <label htmlFor="nome_evento">
                <b>nome_evento</b>
                <br />
              </label>
              <input
                type="text"
                name="nome_evento"
                id="nome_evento"
                className="form-control"
                value={createData.nome_evento}
                onChange={handleCreateChange}
                required
              />
            </div>
            <div className="input-group">
              <label htmlFor="attendees">
                <b>partecipanti</b>
                <br />
              </label>
              <input
                type="text"
                name="attendees"
                id="attendees"
                className="form-control"
                value={createData.attendees}
                onChange={handleCreateChange}
                required
              />
            </div>
            <div className="form-group">
              <label htmlFor="data_evento">
                <b>data_evento</b>
                <br />
              </label>
              <input
                type="datetime-local"
                name="data_evento"
                id="data_evento"
                className="form-control"
                value={createData.data_evento}
                onChange={handleCreateChange}
                required
              />
            </div>
            <div className="btns">
              <button
                type="button"
                className="btn-common-edit"
                onClick={createEvent}
              >
                Creare
              </button>
              <button
                type="button"
                className="btn-common-delete"
                onClick={closeCreateModal}
              >
                Annullamento
              </button>
            </div>
          </Modal>
        </div>
      ) : (
        <div className="form">
          <h2 className="form-title">
            Ciao
            {"  " + user.firstName + " "}ecco i tuoi eventi
          </h2>
          <div className="event-box">
            {events ? (
              events.map((item, index) => {
                return (
                  <div className="card" key={index}>
                    <div className="event-name">{item.nome_evento}</div>
                    <div className="event-data">{item.data_evento}</div>
                    <div className="btn">Unirsi</div>
                  </div>
                );
              })
            ) : (
              <tr>
                <td colSpan="6">
                  <h1 className="text-center">Nessun evento</h1>
                </td>
              </tr>
            )}
          </div>
        </div>
      )}
    </>
  );
};

export default Home;
