import java.io.BufferedReader;
import java.io.FileReader;


class Read{
	public static void main(String args[]){
		Read read = new Read();
		read.read();
	}
	
	public void read(){
		try{
			BufferedReader br = new BufferedReader(new FileReader("test.txt"));
			String line = br.readLine();
			System.out.printf(line);
		}catch(Exception e){
			
		}
	}
}