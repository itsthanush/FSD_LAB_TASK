package com.spring.jdbc.pagination;

import java.util.List;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.data.domain.Sort;
import org.springframework.stereotype.Service;

@Service
public class StudentService {
	
	
	
	private final StudentRepo repo;
	
	
	public StudentService(StudentRepo repo) {
		this.repo=repo;
				
	}
	
	public Student saveStudent(Student student) {
		return repo.save(student);
	}
	
	public List<Student> findStudents() {
		
		return repo.findAll();
		
	}
	
	public Student findByID(Integer id) {
		
		return repo.findById(id).orElse(null);
		
	}
	
	public Student updateStudent(Student student) {
		return repo.save(student);
	}
	
	public void deleteByID(Integer id) {
		
		repo.deleteById(id);
		
	}
	
	public List<Student> getName(String name) {
		return repo.getByName(name);
	}
	
	
	public List<Student> getDepartment(String department) {
		return repo.getByDepartment(department);
	}
	
	
	
	public List<Student> getAge(Integer age){
		return repo.getByAge(age);
		
	}
	
	// Pagination only
    public Page<Student> getStudentsWithPagination(int page, int size) {
        Pageable pageable = PageRequest.of(page, size);
        return repo.findAll(pageable);
    }

    // Pagination + Sorting
    public Page<Student> getStudentsWithPaginationAndSorting(
            int page, int size, String sortBy) {

        Pageable pageable = PageRequest.of(
                page,
                size,
                Sort.by(sortBy)
        );
        return repo.findAll(pageable);
    }

    // Pagination + Sorting (Descending)
    public Page<Student> getStudentsSortedDesc(
            int page, int size, String sortBy) {

        Pageable pageable = PageRequest.of(
                page,
                size,
                Sort.by(sortBy).descending()
        );
        return repo.findAll(pageable);
    }

	
}
