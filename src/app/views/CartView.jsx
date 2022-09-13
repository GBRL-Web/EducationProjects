import React from 'react';

export default function CartView() {
    const cartItems = JSON.parse(localStorage.getItem('cart-items'));
    return (
        <section className="bg-[url('/src/app/assets/images/street-art_retouchee.png')]">
            <div className="w-full text-center">
                <h1>CART ITEMS:</h1>
            </div>
            <div className="w-full text-center">
                {cartItems.length === 0 && <h1>Your shopping list is empty.</h1>}
                {cartItems != null &&
                    cartItems.map((item) => (
                        <div key={item.id} className="w-full text-center">
                            <h1>{item.name}</h1>
                            <h1>{item.qty}</h1>
                        </div>
                    ))}
            </div>
        </section>
    );
}
