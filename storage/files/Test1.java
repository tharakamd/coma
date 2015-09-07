
import java.io.BufferedReader;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.Iterator;

class Test1 {

    public static void main(String[] args) {
        Test1 test = new Test1();
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
                while(it.hasNext()){
                    sum+=it.next();
                }
                System.out.print(sum);
	}
    
}
