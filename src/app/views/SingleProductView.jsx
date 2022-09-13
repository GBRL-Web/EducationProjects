import { faCartArrowDown } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';

export default function SingleView() {
    const params = useParams();
    const [item, setItem] = useState([]);

    useEffect(() => {
        const fetchProducts = async () => {
            const res = await axios.get(
                'https://localhost:8000/api/product/' + params.id,
            );
            setItem(res.data);
        };
        fetchProducts();
    }, []);
    return (
        <section className="bg-[url('/src/app/assets/images/street-art_retouchee.png')] p-8">
            <div className="grid justify-center gap-5 my-10">
                <div className="min-w-screen max-h-screen bg-teal-400 flex items-center p-5 lg:p-10 overflow-hidden relative">
                    <div className="w-full rounded bg-white shadow-xl p-10 lg:p-20 mx-auto text-gray-800 relative md:text-left">
                        <div className="md:flex items-center -mx-10">
                            <div className="w-full md:w-1/2 px-10 mb-10 md:mb-0">
                                <div className="relative">
                                    <img
                                        src={item.imglink}
                                        className="w-full relative z-10"
                                        alt=""
                                    ></img>
                                    <div className="border-4 border-teal-400 absolute top-10 bottom-10 left-10 right-10 z-0"></div>
                                </div>
                            </div>
                            <div className="w-full md:w-1/2 px-10">
                                <div className="mb-10">
                                    <h1 className="font-bold uppercase text-2xl mb-5 nor-font">
                                        {item.name}
                                    </h1>
                                    <p className="text-sm">{item.description}</p>
                                </div>
                                <div>
                                    <div className="inline-block align-bottom mr-5">
                                        <span className="text-2xl leading-none align-baseline">
                                            €
                                        </span>
                                        <span className="font-bold text-5xl leading-none align-baseline nor-font">
                                            {item.price - 1}
                                        </span>
                                        <span className="text-2xl leading-none align-baseline nor-font">
                                            .99
                                        </span>
                                    </div>
                                    <div className="inline-block align-bottom">
                                        <button className="bg-teal-400 opacity-75 hover:opacity-100 text-black hover:text-white hover:bg-teal-600 px-10 py-2 font-semibold nor-font">
                                            <FontAwesomeIcon
                                                icon={faCartArrowDown}
                                                size="2x"
                                                className="mr-4"
                                            ></FontAwesomeIcon>
                                            Add to basket
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
