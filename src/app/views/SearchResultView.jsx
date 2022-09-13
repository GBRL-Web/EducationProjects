import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';

import ProductCard from '../shared/components/container/ProductCard';

export default function SearchView() {
    const [items, setItem] = useState([]);
    let { searchTerm } = useParams();

    useEffect(() => {
        const fetchProducts = async () => {
            const res = await axios.get(
                'https://localhost:8000/api/product/search/' + searchTerm,
            );
            setItem(res.data);
        };
        fetchProducts();
    }, []);

    return (
        <section className="bg-[url('/src/app/assets/images/street-art_retouchee.png')] p-8">
            <div className="grid justify-center md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-7 my-10">
                {items.map((item) => (
                    <div key={item.id}>
                        <ProductCard
                            name={item.name}
                            description={item.description}
                            id={item.id}
                            imglink={item.imglink}
                            price={item.price}
                        />
                    </div>
                ))}
            </div>
        </section>
    );
}
