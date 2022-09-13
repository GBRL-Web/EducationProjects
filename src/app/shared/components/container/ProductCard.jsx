import { faBagShopping, faHeart } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import React, { useState } from 'react';
import { Link } from 'react-router-dom';

export default function ProductCard(props) {
    const { addToCart, isLiked, likeToggle } = props;
    // const [liked, setLiked] = useState();

    // setLiked(isLiked);
    // console.log(props.item.id + ' = ' + isLiked);

    return (
        <div
            key={props.item.id}
            className="sm:w-[140px] md:w-[160px] xl:w-[240px] 2xl:w-[340px] drop-shadow-[5px_5px_1px_rgba(0,0,0,0.65)] ease-in duration-200 hover:drop-shadow-[20px_20px_10px_rgba(0,0,0,0.55)]"
        >
            <div className="overflow-hidden w-full outline outline-teal-400 bg-white">
                <div className="bg-teal-400 sm:h-[4rem] lg:h-[6.25rem] xl:h-[4rem] 2xl:h-[6.25rem] flex-initial text-center">
                    <div className="flex items-center h-full">
                        <h1 className="flex mx-auto relative nor-font sm:text-[1rem] md:text-[2rem] lg:text-[2rem] xl:text-[2rem] 2xl:text-[2.5rem]">
                            {props.item.price - 1}.99€
                        </h1>

                        <FontAwesomeIcon
                            icon={faBagShopping}
                            className="text-gray-400 absolute right-0 pr-4 sm:text-[1rem] md:text-[1.5rem] xl:text-[2rem] 2xl:text-[2.5rem] hover:scale-110 hover:text-white duration-500"
                            onClick={() => addToCart(props.item)}
                        />
                    </div>
                </div>
                <Link to={'/product/productid=' + props.item.id}>
                    <div className="w-full outline outline-teal-400 flex ">
                        <img
                            src={props.item.imglink}
                            alt={props.item.name}
                            className="sm:h-[10rem] lg:h-[15rem] xl:h-[20rem] 2xl:h-[30rem] object-contain justify-content-center"
                        />
                    </div>
                </Link>
                <div className="sm:h-[6rem] md:h-[8rem] lg:h-[6rem] xl:h-[8rem]">
                    <div className="p-4 h-full">
                        <h6 className="line-clamp-3 sm:text-[0.8rem] md:text-[1rem] lg:text-[1.25rem] xl:text-[1.5rem]">
                            {props.item.description}
                        </h6>
                    </div>
                    <div className="sm:p-1 md:p-2 xl:p-4 float-right">
                        <button onClick={() => likeToggle(props.item.id)}>
                            {isLiked && (
                                <FontAwesomeIcon
                                    icon={faHeart}
                                    className={`sm:text-[1rem] md:text-[1.5rem] lg:text-[2rem] xl:text-[3rem] hover:text-pink-400 text-red-500 duration-500`}
                                    // ${!isLiked ? 'text-gray-500' : ''}
                                    // ${isLiked ? 'text-red-500' : ''}
                                />
                            )}
                            {!isLiked && (
                                <FontAwesomeIcon
                                    icon={faHeart}
                                    className="sm:text-[1rem] md:text-[1.5rem] lg:text-[2rem] xl:text-[3rem] hover:text-pink-400 text-gray-200 duration-500"
                                />
                            )}

                            {isLiked}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
}
