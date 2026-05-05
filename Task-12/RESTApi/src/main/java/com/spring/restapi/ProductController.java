package com.spring.restapi;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;


@RestController
@RequestMapping("/api/product")


public class ProductController {

	@Autowired
    private ProductService productService;



    // POST – Add new product
    @PostMapping
    public ProductModel addProduct(@RequestBody ProductModel product) {
        return productService.addProduct(product);
    }
    
    // GET – View all products
    @GetMapping
    public List<ProductModel> getProducts() {
        return productService.getAllProducts();
	
    }
    
    
    
    // GET product using ID
    @GetMapping("/{id}")
    public ProductModel getProductById(@PathVariable int id) {
        return productService.getProductById(id);
    }    
    
    
 // PUT – Update product using ID
    @PutMapping("/{id}")
    public ProductModel updateProduct(@PathVariable int id,
                                 @RequestBody ProductModel product) {
        return productService.updateProduct(id, product);
    }
    
    
 // DELETE – Delete product using ID
    @DeleteMapping("/{id}")
    public String deleteProduct(@PathVariable int id) {
        productService.deleteProduct(id);
        return "Product deleted successfully";
    }




}
