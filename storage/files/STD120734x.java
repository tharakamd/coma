/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.BufferedReader;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.Iterator;

/**
 *this code will give correct results up to 5 inputs
 * @author Dilan
 */
 class STD120734x {
    public static void main(String[] args) {
        STD120734x test = new STD120734x();
        test.read();
    }
    
    public void read(){
                ArrayList<Integer> list = new ArrayList<Integer>();
		try{
			BufferedReader br = new BufferedReader(new FileReader("test.txt"));
                        String line;
                        while((line = br.readLine())!=null){
                            list.add(Integer.parseInt(line));
                        }
		}catch(Exception e){
			
		}
                Iterator<Integer> it = list.iterator();
                int sum = 0;
                int i=0;
                while(it.hasNext()){
                     if(i==2){ 
                        sum-=it.next();
                    }else if(i<2){
                        sum+=it.next();
                    }else if(i<5){
                         it.next();
                    }else{
                        sum+=it.next();
                    }
                                
                    i++;
                }
                System.out.print(sum);
	}
}
