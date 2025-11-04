import {
  Text,
  View,
  StyleSheet,
  Image,
  TextInput,
  TouchableOpacity,
} from 'react-native';
import { useState } from 'react';




const Home = ({ navigation }) => {


  return (

 
    <View style={styles.container}>
     
   
      <TouchableOpacity 
        onPress={() => navigation.navigate('Create')}
        style={styles.button}>
        <Text style={{color:'#FFFFFF'}}>Inserir Dados</Text>
      </TouchableOpacity>
       <TouchableOpacity 
        onPress={() => navigation.navigate('Read')}
        style={styles.button}>
        <Text style={{color:'#FFFFFF'}}>Consutar Dados</Text>
      </TouchableOpacity>
 
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex:1,
    alignItems: 'center',
    justifyContent: 'center',
    padding: 24,
    backgroundColor:"#111F11"
  },

  button:{
          width:200, 
          borderRadius:20,
          padding:5,
          margin:10,
          alignItems:"center",
          borderColor:"white",
          borderWidth:1   
  }



});
export default Home;