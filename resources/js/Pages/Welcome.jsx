import React, { useEffect, useState } from "react";

export default function Welcome(props) {
    const [products, setProducts] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    const getProducts = () => {
        fetch("http://localhost:8000/api/products")
            .then((response) => response.json())
            .then((data) => setProducts(data.result))
            .catch((error) => setError(error))
            .finally(() => setLoading(false));
    };
    useEffect(() => {
        getProducts();
    }, []);
    return (
        <>
            {loading ? (
                "Loading..."
            ) : (
                <>
                    {error ? (
                        "Error!"
                    ) : (
                        <>
                            {products.map((product, i) => (
                                <div key={i}>
                                    <p>Name: {product.product_name}</p>
                                    <p>Type: {product.product_type}</p>
                                    <p>Price: {product.product_price}</p>
                                    <p>expired: {product.expired_at}</p>
                                </div>
                            ))}
                        </>
                    )}
                </>
            )}
        </>
    );
}
