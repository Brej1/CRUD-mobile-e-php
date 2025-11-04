// screens/update.js (CÓDIGO CORRIGIDO)

import React, { useState } from 'react';
import { 
    View, Text, TextInput, TouchableOpacity, 
    StyleSheet, Alert, ScrollView 
} from 'react-native';
import axios from 'axios';

// 🛑 IMPORTANTE: Use seu IP e porta corretos (8081, conforme seu server.js)
const API_URL = 'http://localhost:8081'; 

// 🎯 CORREÇÃO CRÍTICA: Removido 'export' da frente da função.
// Adicionada a prop 'route' para desestruturar os parâmetros passados.
function Update({ route, navigation }) { 
    
    // 1. Recebe o objeto 'pais' do parâmetro de rota (Agora funciona!)
    const { pais } = route.params; 

    // 2. Inicializa o estado com os dados ATUAIS do país
    const [nome, setNome] = useState(pais.nome.toString());
    const [continente, setContinente] = useState(pais.continente.toString());
    const [populacao, setPopulacao] = useState(pais.populacao.toString()); 
    const [idioma, setIdioma] = useState(pais.idioma.toString());

    // ⭐️ FUNÇÃO DE ATUALIZAÇÃO (UPDATE - PUT) ⭐️
    const handleUpdatePais = async () => {
        // 3. Validação básica
        if (!nome || !continente || !populacao || !idioma) {
            Alert.alert('Erro', 'Por favor, preencha todos os campos.');
            return;
        }

        // 4. Monta o objeto com os dados atualizados
        const paisAtualizado = {
            nome,
            continente,
            // Certifique-se de que a população seja um número inteiro antes de enviar
            populacao: parseInt(populacao), 
            idioma
        };
        
        // O ID é o que identifica qual registro será atualizado no banco
        const idParaAtualizar = pais.id_pais;

        try {
            // 5. Envia a requisição PUT para a API
            const response = await axios.put(`${API_URL}/paises/${idParaAtualizar}`, paisAtualizado);
            
            Alert.alert('Sucesso', response.data.message, [
                { 
                    text: "OK", 
                    // 🎯 CORREÇÃO DE NAVEGAÇÃO: Navega diretamente para 'Read' (lista),
                    // em vez de usar goBack(), para maior estabilidade.
                    onPress: () => navigation.navigate('Read') 
                } 
            ]);

        } catch (error) {
            console.error("Erro na Atualização:", error.response ? error.response.data : error.message);
            const erroMsg = error.response ? error.response.data : 'Erro de conexão ou no servidor.';
            Alert.alert('Falha ao Atualizar', erroMsg);
        }
    };

    return (
        <ScrollView contentContainerStyle={styles.scrollContainer}>
            <View style={styles.container}>
           
                
                <TextInput
                    style={styles.input}
                    placeholder="Nome"
                    value={nome}
                    placeholderTextColor="#C0C0C0"
                    onChangeText={setNome}
                />
                <TextInput
                    style={styles.input}
                    placeholder="Continente"
                    value={continente}
                    placeholderTextColor="#C0C0C0"
                    onChangeText={setContinente}
                />
                <TextInput
                    style={styles.input}
                    placeholder="População"
                    value={populacao}
                    onChangeText={setPopulacao}
                    placeholderTextColor="#C0C0C0"
                    keyboardType="numeric"
                />
                <TextInput
                    style={styles.input}
                    placeholder="Idioma"
                    value={idioma}
                    placeholderTextColor="#C0C0C0"
                    onChangeText={setIdioma}
                />
                
                <TouchableOpacity 
                    onPress={handleUpdatePais}
                    style={styles.button}>
                    <Text style={{color:'white'}}>Atualizar</Text>
                </TouchableOpacity>
            </View>
        </ScrollView>
    );
}

const styles = StyleSheet.create({
    scrollContainer: { 
        flexGrow: 1,
        justifyContent: 'center',
        backgroundColor: "#111F11",
    },
    container: {
        flex:1,
        alignItems: 'center',
        justifyContent: 'center',
        padding: 24,
        backgroundColor:"#111F11"
    },
    header: {
        fontSize: 24,
        fontWeight: 'bold',
        color: '#FFFFFF', // Corrigido para ser visível no fundo escuro
        marginBottom: 30,
        textAlign: 'center',
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
    buttonText: {
        color: '#FFFFFF',
        fontWeight: 'bold',
        fontSize: 16,
    },
    input: {
        width:200,   
        padding: 5,
        marginBottom: 10,
        backgroundColor:"white",
        borderRadius:10
    },
});

// 🎯 CORREÇÃO FINAL: Exportação padrão correta.
export default Update;