import axios from 'axios';
import React from 'react';
import { useEffect, useState } from 'react';

const ShowUserView = () => {
    const [user, setUser] = useState([]);
    const id = 3;
    useEffect(() => {
        axios
            .get(`https://localhost:8000/user/${id}`)
            .then((res) => setUser(res.data))
            .catch((error) => console.log(error));
    }, []);

    console.log(user);
    return (
        <div className="background-login bg-gray-800 m-4 h-full">
            <div className="text-center border border-current">
                <h1 className="title">Information personnelle</h1>
            </div>

            <section className=" text-white mt-4">
                <div className="flex my-4">
                    <div className="flex flex-col w-1/2 ml-4 mr-4 bg-black">
                        <label htmlFor="username">Nom :</label>
                        <div className="underline underline-offset-4">{user.name}</div>
                    </div>
                    <div className="flex flex-col w-1/2 ml-4 bg-black">
                        <label htmlFor="name">Prenom :</label>
                        <div className="underline underline-offset-4">
                            {user.username}
                        </div>
                    </div>
                </div>
                <div className="flex my-4">
                    <div className="flex flex-col w-1/2 ml-4 mr-4 bg-black">
                        <label htmlFor="email">Email :</label>
                        <div className="underline underline-offset-4">{user.email}</div>
                    </div>
                    <div className="flex flex-col w-1/2 ml-4 bg-black">
                        <label htmlFor="telephone">Telephone :</label>
                        <div className="underline underline-offset-4">
                            {'0' + user.telephone}
                        </div>
                    </div>
                </div>
                <div className="flex flex-col w-1/4 ml-4 my-4 bg-black">
                    <label htmlFor="BirthDate">Date de naissance :</label>
                    <div className="underline underline-offset-4">{user.BirthDate}</div>
                </div>
            </section>
        </div>
    );
};

export default ShowUserView;
