import {
  Text,
  View,
  StyleSheet,
  Image,
  TextInput,
  TouchableOpacity,
} from 'react-native';
import { useState } from 'react';
import axios from 'axios';


const API_URL = 'http://localhost:8081'; 
const Create = ({ navigation }) => {
  const [nome, setNome] = useState('');
  const [continente, setContinente] = useState('');
  const [populacao, setPopulacao]= useState('');
  const [idioma, setIdioma]=useState('');


const Criar_Pais = async () => {
        if (!nome || !continente || !populacao || !idioma) {
            Alert.alert('Erro', 'Por favor, preencha todos os campos.');
            return;
        }

        const novoPais = {
            nome,
            continente,
            populacao: parseInt(populacao), 
            idioma
        };

        try {
            const response = await axios.post(`${API_URL}/paises`, novoPais);
            
            Alert.alert('Sucesso', response.data.message, [
                // Ao dar OK, ele volta para a tela anterior (ListScreen)
                { text: "OK", onPress: () => navigation.goBack() } 
            ]);

            // O `goBack()` garante que a ListScreen recarregue os dados (devido ao useEffect que criamos lá)
            
        } catch (error) {
            console.error("Erro na Criação:", error.response ? error.response.data : error.message);
            const erroMsg = error.response ? error.response.data : 'Erro de conexão com a API.';
            Alert.alert('Falha ao Criar', erroMsg);
        }
    };
  return (

 
    <View style={styles.container}>
      <TextInput
        style={styles.input}
        placeholder="nome"
        placeholderTextColor="#C0C0C0"
        value={nome}
        onChangeText={setNome}
      />
      <TextInput
        style={styles.input}
        placeholder="continente"
        placeholderTextColor="#C0C0C0"
        value={continente}
        onChangeText={setContinente}
      />
      <TextInput
        style={styles.input}
        placeholder="populacao"
        placeholderTextColor="#C0C0C0"
        value={populacao}
        onChangeText={setPopulacao}
      />
        <TextInput
        style={styles.input}
        placeholder="idioma"
        placeholderTextColor="#C0C0C0"
        value={idioma}
        onChangeText={setIdioma}
      />
   
      <TouchableOpacity 
        onPress={Criar_Pais}
        style={styles.button}>
        <Text style={{color:'#FFFFFF'}}>Inserir Pais</Text>
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
  },
  input: {
    width:200,   
    padding: 5,
    marginBottom: 10,
    backgroundColor:"white",
    borderRadius:10
  },


});
export default Create;