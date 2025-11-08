import React, { useState, useEffect, useCallback } from 'react';
import { View, Text, FlatList, StyleSheet, ActivityIndicator, Alert, TouchableOpacity } from 'react-native';
import axios from 'axios';
import { useFocusEffect } from '@react-navigation/native'; // Hook para recarregar ao focar
import { MaterialIcons } from '@expo/vector-icons';
// 🛑 IMPORTANTE: Use seu IP e porta corretos (8081)
const API_URL = 'http://:8081'; 

// 🎯 CORREÇÃO: O componente agora recebe 'navigation'
export default function Read({ navigation }) { 
  const [paises, setPaises] = useState([]); 
  const [loading, setLoading] = useState(true);

  // Função de busca (fetch)
  const fetchPaises = async () => {
    try {
      setLoading(true);
      const response = await axios.get(`${API_URL}/paises`);
      setPaises(response.data);
    } catch (error) {
      console.error('Erro ao buscar dados:', error.response ? error.response.data : error.message);
      Alert.alert('Erro', 'Não foi possível conectar ao servidor. Verifique a URL ou o backend.');
    } finally {
      setLoading(false);
    }
  };

  // ⭐️ Novo: Função de Exclusão (DELETE) ⭐️
  const handleDeletePais = async (id_pais) => {
    Alert.alert(
      "Confirmar Exclusão",
      `Tem certeza que deseja excluir o país com ID ${id_pais}?`,
      [
        { text: "Cancelar", style: "cancel" },
        { 
          text: "Excluir", 
          onPress: async () => {
            try {
              const response = await axios.delete(`${API_URL}/paises/${id_pais}`);
              Alert.alert('Sucesso', response.data.message);
              fetchPaises(); // Recarrega a lista após a exclusão
            } catch (error) {
              console.error("Erro na Exclusão:", error.response ? error.response.data : error.message);
              const erroMsg = error.response ? error.response.data : 'Erro de conexão ou no servidor.';
              Alert.alert('Falha ao Excluir', erroMsg);
            }
          },
          style: 'destructive'
        },
      ]
    );
  };


  // Usa useFocusEffect para garantir que a lista seja recarregada 
  // toda vez que o usuário volta para esta tela (depois de um Update ou Delete)
  useFocusEffect(
    useCallback(() => {
      fetchPaises();
    }, [])
  );

  // Renderiza cada item (país) na FlatList
  const renderItem = ({ item }) => (
       <View style={styles.container}>
        <View style={styles.item}>
          <Text style={styles.title}>ID: {item.id_pais} - {item.nome}</Text>
          <Text style={styles.detail}>Continente: {item.continente}</Text>
          <Text style={styles.detail}>População: {item.populacao.toLocaleString('pt-BR')}</Text>
          <Text style={styles.detail}>Idioma: {item.idioma}</Text>
          
          <View style={styles.buttonContainer}>
              {/* Botão de EDITAR (navega para Update, passando o item) */}
              <TouchableOpacity 
                  // 🎯 CORRIGIDO: 'navigation' está acessível agora
                  onPress={() => navigation.navigate('Update', { pais: item })} 
                  style={[styles.button]}>
                  <MaterialIcons name="edit" size={30} color="white" />
              </TouchableOpacity>
              
              {/* Botão de EXCLUIR (chama a função de delete) */}
              <TouchableOpacity 
                  onPress={() => handleDeletePais(item.id_pais)} 
                  style={[styles.button]}>
                  <MaterialIcons name="delete" size={30} color="white" />
              </TouchableOpacity>
          </View>
        </View>
      </View>
  );

  if (loading) {
    return (
      <View style={styles.containerLoading}>
        <ActivityIndicator size="large" color="#FFFFFF" />
        <Text style={{ color: '#FFFFFF' }}>Carregando países...</Text>
      </View>
    );
  }

  return (
    <View style={styles.container}>
   
      <FlatList
        data={paises}
        keyExtractor={item => item.id_pais.toString()}
        renderItem={renderItem}
        ListEmptyComponent={() => <Text style={styles.emptyText}>Nenhum país encontrado.</Text>}
      />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#111F11',
    paddingTop: 20,
    paddingHorizontal: 10,
  
  },
  containerLoading: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#111F11',
  },
 
  item: {
    backgroundColor: 'black',
    padding: 15,
    borderRadius: 10,
    marginBottom: 15,
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,
    alignItems:'center',

  },
  title: {
    fontSize: 18,
    fontWeight: 'bold',
    color: '#FFFFFF',
    marginBottom: 5,
  },
  detail: {
    fontSize: 14,
    color: '#CCCCCC',
  },
  buttonContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 15,
  },
  button: {
    color:'white',
      width:200, 
    borderRadius:20,
     padding:5,
    margin:10,
    alignItems:"center",
    borderColor:"white",
    borderWidth:1  
  },
 
  emptyText: {
    color: '#AAAAAA',
    textAlign: 'center',
    marginTop: 50,
  },
});
