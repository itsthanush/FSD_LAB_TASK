package com.spring.restapi;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.stereotype.Service;

@Service
public class ProductService {
	
/*	 private List<ProductModel> productList = new ArrayList<>();
	
	//private Map<Integer, ProductModel> productMap = new HashMap<>();

	    // POST – Add product
	    public ProductModel addProduct(ProductModel product) {
	    	productList.add(product);
	        return product;
	    }

	    // GET – View all products
	    public List<ProductModel> getAllProducts() {
	        return productList;
	    }
	    
	    
	    
	 // GET product by ID
	    public ProductModel getProductById(int id) {
	        for (ProductModel p : productList) {
	            if (p.getId() == id) {
	                return p;
	            }
	        }
	        return null;
	    }
	    
	   */
	    
	    
	 private Map<Integer, ProductModel> productMap = new HashMap<>();

    // POST – Add product
    public ProductModel addProduct(ProductModel product) {
        productMap.put(product.getId(), product);   // Correct method
        return product;
    }

    // GET – View all products
    public List<ProductModel> getAllProducts() {
        return new ArrayList<>(productMap.values()); // Convert Map values to List
    }

    // GET product by ID
    public ProductModel getProductById(int id) {
        return productMap.get(id);
    }

    // PUT – Update product
    public ProductModel updateProduct(int id, ProductModel product) {
        product.setId(id);             // keep same ID
        productMap.put(id, product);   // replaces existing product
        return product;
    }   
    
 // DELETE – Remove product
    public void deleteProduct(int id) {
        productMap.remove(id);
    }

	    
 

}
