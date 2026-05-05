package com.spring.mvc;

import java.util.ArrayList;
import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;


@Controller
public class EmpController {
	
	@GetMapping("/hello/emp")
	public String getEmployee(Model model) {
		
		
		List<EmpModel> emlList = new ArrayList<EmpModel>();
		
		emlList.add(new EmpModel(1, "Rahul", "CSE"));
		emlList.add(new EmpModel(2, "Amit", "IT"));
	
			
		model.addAttribute("emp", emlList);
		
		return "emp";
		
		
	}

}
