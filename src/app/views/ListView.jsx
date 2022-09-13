import axios from 'axios';
import React, { useEffect, useState } from 'react';

import Carousel from '../shared/components/container/Carousel';
import LoginModal from '../shared/components/container/LoginModal';
import ProductCard from '../shared/components/container/ProductCard';
import { isAuthenticated } from '../shared/services/accountServices';

const now = new Date();
console.log('Loading up any local databases(if exists)...');
const cartFromLocal = JSON.parse(localStorage.getItem('cart-items'));
const localItems = JSON.parse(localStorage.getItem('items-local')) || [];

export default function ListView() {
    const [items, setItems] = useState(localItems.items);
    const [show, setShow] = useState(false);
    const [shoppingCart, setCart] = useState(cartFromLocal);
    const [selected, setSelected] = useState([]);
    const [loading, setLoading] = useState(true);
    // const [likeArray, setLikeArray] = useState([]);

    // Shuffle 8 products on main page.
    const sortItems = async (items) => {
        console.log('Sorting items...');
        var shuffle = items;
        const shuffled = shuffle.sort(() => 0.5 - Math.random());
        setSelected(shuffled.slice(0, 8));
        setLoading(false);
    };

    // Fetch products function from server
    const fetchProducts = async () => {
        console.log('Fetching products from database...');
        const res = await axios.get('https://localhost:8000/api/product/');
        const items = {
            date: now,
            items: res.data,
        };
        console.log('Setting items in local storage.');
        localStorage.setItem('items-local', JSON.stringify(items));
        sortItems(items.items);
        console.log(items.items);
    };

    // Function to open/close modal
    const loginModal = () => {
        setShow(!show);
    };

    // Add to cart function passed to Product Card.
    const addToCart = (item) => {
        console.log('Add to cart activated.');
        console.log(item);
        const exist = shoppingCart.find((cartItem) => cartItem.id === item.id) || null;
        console.log(exist);
        if (exist) {
            console.log('Product exists in cart already.');
        } else {
            console.log('Product does not exists in cart, adding...');
            setCart([...shoppingCart, { ...item, qty: 1 }]);
            console.log('Add to cart: ' + shoppingCart);
        }
    };

    // Conditional to take Token.
    if (isAuthenticated() === true) {
        const userToken = JSON.stringify(localStorage.getItem('token').substring(0, 36));
    }

    useEffect(() => {
        // check for localitem array if emtpy
        console.log('Checking for local items array...');
        console.log('Local Items type: ' + typeof localItems.items);
        if (
            typeof localItems.items === 'undefined' ||
            (now > localItems.date && now.getHours() >= localItems.date.getHours() + 4)
        ) {
            console.log('Creating/refreshing local-database...');
            fetchProducts();
        } else {
            console.log('Database found!');
            sortItems(items);
            setLoading(false);
        }
    }, [loading]);

    useEffect(() => {
        // setCart(JSON.parse(localStorage.getItem('cart-items')));
        console.log('UseEffect Cart: ' + shoppingCart);
        localStorage.setItem('cart-items', JSON.stringify(shoppingCart));
    }, [shoppingCart]);

    // // Function to remove a number from array
    // function arrayRemove(arr, value) {
    //     return arr.filter(function (ele) {
    //         return ele != value;
    //     });
    // }

    // // Toggle likes, save in localStorage and local array
    // const likeToggle = (num) => {
    //     if (userToken === null) {
    //         console.log('User not logged in.', userToken);
    //         loginModal();
    //     } else {
    //         if (likeArray.includes(num)) {
    //             setLikeArray(arrayRemove(likeArray, num));
    //         } else {
    //             setLikeArray((likeArray) => [...likeArray, num]);
    //             console.log(likeArray);
    //         }
    //     }
    //     localStorage.setItem('is-liked-' + userToken, JSON.stringify(likeArray));
    // };

    // Add/remove to/from cart function
    // const localCart = localStorage.getItem('cart-local-' + userToken);

    // if (isAuthenticated() && shoppingCart.length < localCart.length) {
    //     localStorage.setItem('cart-local-' + userToken, JSON.stringify(shoppingCart));
    // } else if (!shoppingCart) {
    //     console.log('no shopin cart')
    // }

    // if (isAuthenticated() && localStorage.getItem('is-liked-' + userToken) === null) {
    //     const likeInfo = [...likeArray, 0];
    //     console.log('No likes local db found. Creating one.', likeInfo);
    //     localStorage.setItem('is-liked-' + userToken, JSON.stringify(likeInfo));
    // } else if (isAuthenticated() && localStorage.getItem('is-liked-' + userToken)) {
    //     setLikeArray(JSON.parse(localStorage.getItem('is-liked-' + userToken)));
    // }

    return (
        <section>
            {/* Modal for being not logged in. */}
            {show && <LoginModal loginModal={loginModal} />}
            {/* Carousel */}

            <Carousel />

            {/* Items list */}
            <div className="bg-gradient-to-r from-teal-400 text-white block h-[60px] via-transparent my-4 outline outline-2 outline-offset-2 ring-white">
                <h1 className="nor-font ml-10">OUR PRODUCTS INCLUDE</h1>
            </div>
            {!loading ? (
                <div className="p-10 grid grid-cols-4 md:gap-6 sm:gap-5 lg:gap-10 xl:gap-12 content-center">
                    {selected.map((item) => (
                        <div key={item.id} className="place-self-center">
                            <ProductCard
                                item={item}
                                // isLiked={likeArray.includes(item.id) ? 'true' : 'false'}
                                // userToken={userToken}
                                loginModal={loginModal}
                                addToCart={addToCart}
                                // likeToggle={likeToggle}
                            />
                        </div>
                    ))}
                </div>
            ) : (
                <h2 className="text-center nor-font">Loading items...</h2>
            )}
            <div className="bg-gradient-to-r from-teal-400 text-white block h-[60px] via-transparent my-4 outline outline-2 outline-offset-2 ring-white">
                <h1 className="nor-font ml-10">BY CATEGORY</h1>
            </div>
            <div className="flex flex-row">
                <div className="basis-1/1 md:basis-1/2 p-10 float-left ">
                    <h3 className="pl-2 mb-10 nor-font bg-gradient-to-r from-teal-400 via-transparent">
                        Men Plain T-shirt
                    </h3>
                    <img
                        src="/src/app/assets/images/mockup_nude_t-shirt.png"
                        alt="..."
                        className="w-[800px] h-[440px] drop-shadow-[5px_5px_1px_rgba(0,0,0,0.65)] ease-in duration-200 hover:drop-shadow-[20px_20px_10px_rgba(0,0,0,0.55)]"
                    />
                </div>
                <div className="basis-1/1 md:basis-1/2 p-10 float-right">
                    <h3 className="pl-2 mb-10 nor-font bg-gradient-to-r from-teal-400 via-transparent">
                        Men Printed T-shirt
                    </h3>
                    <img
                        src="/src/app/assets/images/mockup_print_t-shirt.png"
                        alt="..."
                        className="w-[800px] h-[440px] drop-shadow-[5px_5px_1px_rgba(0,0,0,0.65)] ease-in duration-200 hover:drop-shadow-[20px_20px_10px_rgba(0,0,0,0.55)]"
                    />
                </div>
            </div>

            <div className="bg-white flex flex-row nor-font">
                <div className="basis-1/4 md:basis-1/3 p-10">
                    <h3 className="pl-2 mb-10 nor-font bg-gradient-to-r from-teal-400 via-transparent">
                        Women Vest
                    </h3>
                    <img
                        src="/src/app/assets/images/mockup_women_jacket.png"
                        alt="..."
                        className="drop-shadow-[5px_5px_1px_rgba(0,0,0,0.65)] ease-in duration-200 hover:drop-shadow-[20px_20px_10px_rgba(0,0,0,0.55)]"
                    />
                </div>
                <div className="basis-1/4 md:basis-1/3 p-10">
                    <h3 className="pl-2 mb-10 nor-font bg-gradient-to-r from-teal-400 via-transparent">
                        Women Accessories
                    </h3>
                    <img
                        src="/src/app/assets/images/braka_women-jacket.png"
                        alt="..."
                        className="drop-shadow-[5px_5px_1px_rgba(0,0,0,0.65)] ease-in duration-200 hover:drop-shadow-[20px_20px_10px_rgba(0,0,0,0.55)]"
                    />
                </div>
                <div className="basis-1/4 md:basis-1/3 p-10 ">
                    <h3 className="pl-2 mb-10 nor-font bg-gradient-to-r from-teal-400 via-transparent">
                        Women Plain T-shirt
                    </h3>
                    <img
                        src="/src/app/assets/images/mockup_gothic.png"
                        alt="..."
                        className="drop-shadow-[5px_5px_1px_rgba(0,0,0,0.65)] ease-in duration-200 hover:drop-shadow-[20px_20px_10px_rgba(0,0,0,0.55)]"
                    />
                </div>
            </div>
        </section>
    );
}
