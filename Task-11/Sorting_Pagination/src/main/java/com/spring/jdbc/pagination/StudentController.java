package com.spring.jdbc.pagination;

import java.util.List;

import org.springframework.data.domain.Page;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/student")

public class StudentController {
	
	private final StudentService service;
	
	public StudentController(StudentService service) {
		this.service=service;
		
	}
	
	// CREATE
    @PostMapping
    public Student createStudent(@RequestBody Student student) {
        return service.saveStudent(student);
    }

    // READ ALL
    @GetMapping
    public List<Student> getAllStudents() {
        return service.findStudents();
    }

    // READ BY ID
    @GetMapping("/{id}")
    public Student getStudent(@PathVariable Integer id) {
        return service.findByID(id);
    }
    
    
    // READ BY Name
    @GetMapping("name/{name}")
    public List<Student> getByName(@PathVariable String name) {
        return service.getName(name);
    }
    
    
    // READ BY Email
  //  @GetMapping("email/{email}")
  //  public List<Student> getByEmail(@PathVariable String email) {
  //      return service.getEmail(email);
  //  }
    
    
    // READ BY Department
    @GetMapping("department/{dept}")
    public List<Student> getByDepartment(@PathVariable String dept) {
        return service.getDepartment(dept);
    }
    
    
    // READ BY Age
    @GetMapping("age/{age}")
    public List<Student> getByAge(@PathVariable Integer age) {
        return service.getAge(age);
    }

    // UPDATE
    @PutMapping("/{id}")
    public Student updateStudent(
            @PathVariable int id,
            @RequestBody Student student) {

        student.setId(id);
        return service.updateStudent(student);
    }

    // DELETE
    @DeleteMapping("/{id}")
    public String deleteStudent(@PathVariable int id) {
        service.deleteByID(id);
        return "Student deleted successfully";
    }
    
    
    
 // Pagination only
    @GetMapping("/page")
    public Page<Student> getStudentsPaginated(
            @RequestParam int page,
            @RequestParam int size) {
        return service.getStudentsWithPagination(page, size);
    }

    // Pagination + Sorting (ASC)
    @GetMapping("/page-sort")
    public Page<Student> getStudentsPaginatedSorted(
            @RequestParam int page,
            @RequestParam int size,
            @RequestParam String sortBy) {

        return service.getStudentsWithPaginationAndSorting(
                page, size, sortBy);
    }

    // Pagination + Sorting (DESC)
    @GetMapping("/page-sort-desc")
    public Page<Student> getStudentsPaginatedSortedDesc(
            @RequestParam int page,
            @RequestParam int size,
            @RequestParam String sortBy) {

        return service.getStudentsSortedDesc(
                page, size, sortBy);
    }

		
	

}
