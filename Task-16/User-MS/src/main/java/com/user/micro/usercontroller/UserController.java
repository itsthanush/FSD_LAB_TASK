package com.user.micro.usercontroller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.core.env.Environment;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fasterxml.jackson.datatype.jsr310.deser.InstantDeserializer.FromDecimalArguments;

@RestController
@RequestMapping("/user")
public class UserController {
	
	@Autowired
	private Environment env;
	
	@GetMapping("/status/check")
	public String Status()
	{
		//return("Welcome to Spring boot from Client-1");
		return "Port Number: "+env.getProperty("local.server.port");
	}

}
